<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Mail\AdminOnboarded;
use App\Models\CentralUser;
use App\Models\Tenant;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function show(Request $request)
    {
        // Get currently authenticated user
        if ($user = $request->user()) {
            return $this->redirectUserToTenantOrShowTenantSelector($user);
        }

        return view('auth/sso-login');
    }

    protected function redirectUserToTenantOrShowTenantSelector()
    {
        return redirect('/dashboard');
    }

    public function redirectUserToTenant(User|string|int $user, Tenant|string|int $tenant)
    {
        if (!$tenant instanceof Tenant) {
            $tenant = Tenant::find($tenant);

            if (is_null($tenant)) {
                throw new Exception('Tenant with the key passed in the "tenant" parameter does not exist');
            }
        }

        $centralUser = CentralUser::find(Auth::user()->id);
        $globalUserId = $centralUser->global_id;
        $tenantUser = $tenant->run(fn () => User::firstWhere('global_id', $globalUserId));

        return redirect($tenant->impersonationUrl($tenantUser->id));
    }


    /**
     * Handle an incoming authentication request.
     */
    public function ssoLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return redirect('/dashboard');
        }

        return back()->withInput()->withErrors(['Invalid username or password entered.']);
    }

    public function centralDashboard()
    {
        $user = Auth::user();

        $availableTenants = CentralUser::firstWhere('global_id', $user->global_id)->tenants;

        return view('home/dashboard')->with(['tenants' => $availableTenants]);
    }

    public function createCompany(Request $request)
    {
        $user = Auth::user();
        $centralUser = CentralUser::find($user->id);

        $request->validate([
            'company' => 'required|string|max:255',
        ]);

        $domain = $request->company;
        $domain = strtolower($domain);
        $domain = str_replace(' ', '-', $domain);
        $domain = $domain . '.' . config('tenancy.central_domains')[0];

        $validator = Validator::make([
            'domain' => $domain
        ], [
            'domain' => 'required|string|max:48|unique:domains'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $organizationId = str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT);


        $tenant = Tenant::create([
            'domain' => $domain,
            'company' => $request->company,
            'organization_id' => $organizationId,
            'global_id' => $centralUser->global_id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'password' => $user->password
        ]);
        $tenant->createDomain(['domain' => $domain]);

        Mail::to($user->email)->queue(new AdminOnboarded($domain, strtoupper($request->company)));

        return back();
    }

    public function logoutCentral(Request $request)
    {
        // Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
