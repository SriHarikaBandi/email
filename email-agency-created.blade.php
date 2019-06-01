@component('mail::message')
# Welcome to Drughelp.care
Hi {{$user->full_name}},  
Welcome to {{ config('app.name') }}. Below are your login credential details  
Name: {{$agency->name}}  
Address: {{$agency->address}}  

Thanks,<br>
{{ config('app.name') }}
@endcomponent