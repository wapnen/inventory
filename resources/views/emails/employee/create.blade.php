@component('mail::message')


@component('mail::panel')
Dear {{$user->firstname}} , <br>
You have been enrolled as an employer on Maryam's store. Your login details are as follows <br>
Email : {{$user->email}} <br>
Password : {{$password}} <br>

Login to start using Maryam's store


@endcomponent

@component('mail::button', ['url' => url('/login')])
Sign in
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
