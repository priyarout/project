@component('mail::message')

# Verify Your Profile


Your email address [{{ $notifiable->email }}]({{ "mailto:$notifiable->email" }}) was used to create a profile .
Your unique id is {{ $notifiable->id }}



If you did not register, please disregard this email.

Thank you,

{{ config('app.name') }}
@endcomponent