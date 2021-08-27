@component('mail::message')
# {{ $title}}

{!! subStr($body,0,300) !!}


@component('mail::button', ['url' => $url.$slug])
Read Post
@endcomponent




Thanks,<br>
{{ config('app.name') }}
@endcomponent


