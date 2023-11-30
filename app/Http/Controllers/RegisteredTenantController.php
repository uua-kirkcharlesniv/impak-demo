<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterTenantRequest;
use App\Models\CentralUser;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;


class RegisteredTenantController extends Controller
{
    public function store(RegisterTenantRequest $request)
    {
        $tenant = Tenant::create($request->validated());
        $tenant->createDomain(['domain' => $request->domain]);

        return redirect(tenant_route($tenant->domains()->first()->domain, 'login'));
    }

    public function createCentralAccount(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => [
                'required', 'max:255', Password::defaults(),
            ],
        ]);

        $user = CentralUser::create([
            'global_id' => 'acme',
            'name' => 'John Doe',
            'email' => 'john@localhost',
            'password' => 'secret',
            'role' => 'superadmin', // unsynced
        ]);
    }
}
