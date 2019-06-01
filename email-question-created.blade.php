@component('mail::message')
# Welcome to Drughelp.care
Hi,  
Welcome to {{ config('app.name') }}. 

New question has been created succesfully.
Question: {{$question->name}}  
Description: {{$feature->description}}

This question has been created under {{$feature->name}} feature.

Thanks,<br>
{{ config('app.name') }}
@endcomponent