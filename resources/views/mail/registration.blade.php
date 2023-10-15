@component('mail::message')

# Verify Your Profile


Your email address [{{ $notifiable->email }}]({{ "mailto:$notifiable->email" }}) was used to create a profile .
Please verify your email address by clicking the button below.

@component('mail::button', ['url' =>  route('confirmEmail',[$notifiable->verificationToken]), 'color'=>'green'])
Verify Profile
@endcomponent

If you did not register, please disregard this email.

Thank you,

{{ config('app.name') }}
@endcomponent