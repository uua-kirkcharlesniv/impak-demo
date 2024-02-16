<div class="grow">

    <!-- Panel body -->
    <div class="p-6 space-y-6">
        <h2 class="text-2xl text-slate-800 font-bold mb-5">My Account</h2>

        <!-- Picture -->
        @livewire('profile.update-profile-information-form')

        <!-- Email -->
        <section>
            <form action="{{ route('updateEmailWeb') }}" method="POST">
                @csrf
                <h3 class="text-xl leading-snug text-slate-800 font-bold mb-1">Email</h3>
                <div class="text-sm">Your account registered email address</div>
                <div class="flex flex-wrap mt-5">
                    <div class="mr-2">
                        <label class="sr-only" for="email">Business email</label>
                        <input id="email" name="email" class="form-input" type="email" value="{{ Auth::user()->email }}" />
                    </div>
                    <button class="btn border-slate-200 hover:border-slate-300 shadow-sm text-indigo-500">Change</button>
                </div>
                @if ($errors->updateEmail->any())
                <div class="mt-4">
                    <div class="px-4 py-2 rounded-sm text-sm bg-rose-100 border border-rose-200 text-rose-600">
                        <div class="font-medium">{{ __('Whoops! Something went wrong.') }}</div>
                        <ul class="mt-1 list-disc list-inside text-sm">
                            @foreach ($errors->updateEmail->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
                @if (session()->has('updateEmailMessage'))
                <div class="mt-4">
                    <div class="px-4 py-2 rounded-sm text-sm bg-green-100 border border-green-200 text-green-600">
                        <div class="font-medium">{{ session()->get('updateEmailMessage') }}</div>
                    </div>
                </div>
                @endif
            </form>
        </section>

        <!-- Password -->
        <section>
            <form action="{{ route('updatePasswordWeb') }}" method="POST">
                @csrf
                <h3 class="text-xl leading-snug text-slate-800 font-bold mb-1">Password</h3>
                <div class="text-sm">Update your password</div>
                <div class="mt-5">
                    <div class="w-1/3">
                        <x-jet-label for="password" value="{{ __('Current Password') }}" />
                        <x-password-input id="old_password" type="password" name="old_password" required />
                    </div>
                    <div class="w-1/3 mt-2">
                        <x-jet-label for="password" value="{{ __('Password') }}" />
                        <x-password-input id="new_password" type="password" name="new_password" required />
                    </div>
                    <div class="w-1/3 mt-2">
                        <x-jet-label for="password" value="{{ __('Confirm Password') }}" />
                        <x-password-input id="confirm_password" type="password" name="confirm_password" required />
                    </div>
                    <button class="btn border-slate-200 shadow-sm mt-4 text-indigo-500">Set New Password</button>
                </div>
                @if ($errors->updatePassword->any())
                <div class="mt-4">
                    <div class="px-4 py-2 rounded-sm text-sm bg-rose-100 border border-rose-200 text-rose-600">
                        <div class="font-medium">{{ __('Whoops! Something went wrong.') }}</div>
                        <ul class="mt-1 list-disc list-inside text-sm">
                            @foreach ($errors->updatePassword->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
                @if (session()->has('updatePasswordMessage'))
                <div class="mt-4">
                    <div class="px-4 py-2 rounded-sm text-sm bg-green-100 border border-green-200 text-green-600">
                        <div class="font-medium">{{ session()->get('updatePasswordMessage') }}</div>
                    </div>
                </div>
                @endif
            </form>
        </section>
    </div>
</div>
