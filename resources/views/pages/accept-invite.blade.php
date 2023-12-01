<x-empty-layout>
    <main class="bg-white">

        <div class="relative flex">

            <!-- Content -->
            <div class="w-full md:w-1/2">

                <div class="min-h-screen center h-full my-auto px-4 py-8 flex items-center justify-center">

                    <div class="max-w-md mx-auto">

                        <h1 class="text-3xl text-slate-800 font-bold mb-6">Set up your account 🔒</h1>
                        <!-- Form -->
                        <form method="POST" action="{{ route('process-accept') }}">
                            @csrf
                            <div class="space-y-4">
                                <x-jet-input id="token" type="password" name="token" required
                                    value="{{ $token }}" hidden />

                                <div>
                                    <x-jet-label for="password" value="{{ __('Password') }}" />
                                    <x-jet-input id="password" type="password" name="password" required
                                        autocomplete="new-password" />
                                </div>

                                <div>
                                    <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                    <x-jet-input id="password_confirmation" type="password" name="password_confirmation"
                                        required autocomplete="new-password" />
                                </div>
                            </div>

                            <x-jet-validation-errors class="mt-4" />

                            <div class="flex items-center justify-between mt-6">
                                <div class="mr-1">

                                </div>
                                <x-jet-button>
                                    {{ __('Accept Invitation') }}
                                </x-jet-button>
                            </div>
                        </form>


                    </div>

                </div>

            </div>

            <!-- Image -->
            <div class="hidden md:block absolute top-0 bottom-0 right-0 md:w-1/2" aria-hidden="true">
                <img class="object-cover object-center w-full h-full" src="{{ asset('images/onboarding-image.jpg') }}"
                    width="760" height="1024" alt="Onboarding" />
                <img class="absolute top-1/4 left-0 -translate-x-1/2 ml-8 hidden lg:block"
                    src="{{ asset('images/auth-decoration.png') }}" width="218" height="224"
                    alt="Authentication decoration" />
            </div>

        </div>

    </main>
</x-empty-layout>
