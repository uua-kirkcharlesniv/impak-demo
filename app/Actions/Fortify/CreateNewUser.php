<?php

namespace App\Actions\Fortify;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     */
    public function create(array $input)
    {
        $domain = str_replace(' ', '-', strtolower($input['company']));
        if (strlen($domain) > 48) {
            $domain = substr($domain, 0, 48);
        }
        $input['domain'] = $domain. '.' . config('tenancy.central_domains')[0];
        Validator::make($input, [
            'company' => 'required|string|max:255',
            'domain' => 'required|string|max:48|unique:domains',
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();
        
        $tenant = Tenant::create($input);
        $tenant->createDomain(['domain' => $domain]);
    }
}
