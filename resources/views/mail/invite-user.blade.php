<x-mail::message>
<a style="font-weight: 700; color: rgb(79 70 229)" href="mailto:{{ $inviter }}">{{ $inviter }}</a> invited you to be a member of {{ $company }} on
Impak.
<x-mail::button :url="$url">
Accept invite
</x-mail::button>
<span>
This invite will expire in 7 days. If you do not recognize this, you may safely ignore it. If you have any
additional questrions or concerns, please <a href="http://impak.test/contact"
style="color: rgb(79 70 229)">contact us</a> or you may visit our <a href="https://impak.test/help"
style="color: rgb(79 70 229)">Help Center</a>.
</span>
</x-mail::message>
