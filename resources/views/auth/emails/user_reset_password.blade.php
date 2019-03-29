@component('mail::message')
Welcome {{ $data['data']->name }} <br>
# Reset your Account

you forgot your account password Click the button below to reset it .

@component('mail::button', ['url' => url('reset/password/'.$data['token'])])
Reset your Password
@endcomponent

or Click the link below
<a target="_blank" href="{{ url('reset/password/'.$data['token']) }}"> {{ url('reset/password/'.$data['token']) }} </a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
