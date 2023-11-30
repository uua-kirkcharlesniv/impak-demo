<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterTenantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'company' => 'required|string|max:255',
            'domain' => 'required|string|max:48|regex:/^[A-Za-z. -]+$/|unique:domains',
            'organization_id' => 'required|numeric|unique:tenants',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => [
                'required', 'max:255', Password::defaults(),
            ],
        ];
    }

    public function prepareForValidation()
    {
        $domain = $this->company;
        $domain = strtolower($domain);
        $domain = str_replace(' ', '-', $domain);

        $this->merge([
            'domain' => $domain . '.' . config('tenancy.central_domains')[0],
            'organization_id' => str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT),
        ]);
    }
}
