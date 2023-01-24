@component('mail::message')

{!! $message !!}

@component('mail::button', ['url' => route('home') ])
{{ __('Go to website') }}
@endcomponent

{{ __('Regards') }},<br>
{{ config('app.name') }}

@endcomponent