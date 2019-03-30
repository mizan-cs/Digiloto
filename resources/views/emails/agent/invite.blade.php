@component('mail::message')
# {{$invite->organizer->title}} agent invitation.

Hi,
You Have been invited to be a agent for {{$invite->organizer->title}}.

@component('mail::button', ['url' => route('organizer.agent.create',$invite->token)])
Click Here to Confirm Your Email.
@endcomponent

If you are not interested to become a agent for {{$invite->organizer->title}}. Skip this mail.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
