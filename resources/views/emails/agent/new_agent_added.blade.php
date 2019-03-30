@component('mail::message')
# {{$agent->name}} has been added to your agents list.

Now {{$agent->name}} can create game from your operator.

@component('mail::button', ['url' => route('organizer.agent.index')])
See My Agent List
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
