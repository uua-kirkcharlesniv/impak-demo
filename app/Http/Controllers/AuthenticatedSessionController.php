<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Tenant;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    /**
     * Handle an incoming authentication request.
     */
    public function ssoLogin(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            // 'email' => ['required', 'string', 'email'],
            'organization_id' => 'required|exists:tenants,organization_id'
        ]);
        $tenant = Tenant::where('organization_id', $validated['organization_id'])->first();
        // $tenant->requested_email = $validated['email'];
        return $tenant->run(function ($tenant) {
            // session()->put('email', $tenant->requested_email);

            return redirect(tenant_route($tenant->domains()->first()->domain, 'login'));
        });
    }

    public function centralDashboard()
    {
        return view('home/dashboard');
    }
}
