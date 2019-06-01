@component('mail::message')
# Welcome to Drughelp.care
Hi,  
Welcome to {{ config('app.name') }}. 

Category has been created succesfully
Name: {{$category->name}}  
Description: {{$category->description}}


Thanks,<br>
{{ config('app.name') }}
@endcomponent