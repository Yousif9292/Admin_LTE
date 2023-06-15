@component('mail::message')

<h1>{{ $emailData['subject'] }}</h1>

<p>{{ $emailData['message'] }}</p>
<p href="#">{{ $emailData['to'] }}</p>

@component('mail::button', ['url' => route('dashboard')])
Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}

@endcomponent


