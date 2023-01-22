@component('mail::message')

{!! $message !!}

@component('mail::button', ['url' => ''])
{{ __('Go to website') }}
@endcomponent

{{ __('Regards') }},<br>
{{ config('app.name') }}
@endcomponent
