@component('mail::message')
# Reset Password

Token: {{ $token }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
