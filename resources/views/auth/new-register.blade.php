<x-authentication-layout>
    <h1 class="text-3xl text-slate-800 font-bold mb-6">{{ __('Create your Account') }} ✨</h1>
    <!-- Form -->
    <form method="POST" action="{{ route('create-account') }}">
        @csrf
        <div class="space-y-4">
            <div class="flex flex-row gap-4">
                <div class="flex">
                    <div>
                        <x-jet-label for="first_name">{{ __('First Name') }} <span class="text-rose-500">*</span></x-jet-label>
                        <x-jet-input id="first_name" type="text" name="first_name" :value="old('first_name')" required autocomplete="first_name" />
                    </div>
                </div>
                <div class="flex">
                    <div>
                        <x-jet-label for="last_name">{{ __('Last Name') }} <span class="text-rose-500">*</span></x-jet-label>
                        <x-jet-input id="last_name" type="text" name="last_name" :value="old('last_name')" required autocomplete="last_name" />
                    </div>
                </div>
            </div>

            <div>
                <x-jet-label for="email">{{ __('Email Address') }} <span class="text-rose-500">*</span></x-jet-label>
                <x-jet-input id="email" type="email" name="email" :value="old('email')" required />
            </div>

            <div>
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-password-input id="password" name="password" required autocomplete="new-password" />
            </div>

            <div>
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-password-input id="password_confirmation" name="password_confirmation" required autocomplete="new-password" />
            </div>
        </div>
        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
        <div class="mt-6">
            <label class="flex items-start">
                <input type="checkbox" class="form-checkbox mt-1" name="terms" id="terms" />
                <span class="text-sm ml-2">
                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                    'terms_of_service' =>
                    '<a target="_blank" href="' .
                                route('terms.show') .
                                '" class="text-sm underline hover:no-underline">' .
                        __('Terms of Service') .
                        '</a>',
                    'privacy_policy' =>
                    '<a target="_blank" href="' .
                                route('policy.show') .
                                '" class="text-sm underline hover:no-underline">' .
                        __('Privacy Policy') .
                        '</a>',
                    ]) !!}
                </span>
            </label>
        </div>
        @endif
        <div class="flex items-center justify-between mt-6">
            <x-jet-button>
                {{ __('Sign Up') }}
            </x-jet-button>
        </div>
    </form>
    <x-jet-validation-errors class="mt-4" />
    <!-- Footer -->
    <div class="pt-5 mt-6 border-t border-slate-200">
        <div class="text-sm">
            {{ __('Have an account?') }} <a class="font-medium text-indigo-500 hover:text-indigo-600" href="/login">{{ __('Sign In') }}</a>
        </div>
    </div>
</x-authentication-layout>
