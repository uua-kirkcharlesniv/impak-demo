<x-mail::message>
## Amazing {{ \Carbon\Carbon::now()->englishDayOfWeek }}, {{ $user->first_name }}!

We are great to have you here at Impak! Start using our platform now, by logging in with the credentials below.

**Email**: {{ $user->email }}
<br>
**Password**: {{ $password }}

<x-mail::button :url="route('login')">
    Login
</x-mail::button>

Thanks,<br>
Your team at <a href="https://impak.app">Impak</a>.
</x-mail::message>
