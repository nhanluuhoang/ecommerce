@component('mail::message')
# User account created

Account information:
<ul>
    <li>Account owner: {{ $user->full_name }}</li>
    <li>Phone: {{ $user->phone }}</li>
    <li>Password: {{ $password }}</li>
</ul>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
