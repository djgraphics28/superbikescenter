<x-mail::message>
# Thank you for your inquiry, {{ $data['name'] }}!

We have received your message and will get back to you shortly. <br>Here is a copy of your message:

{{ $data['message'] }}

You inquired about the following motorcycle and model: {{ $data['motorcycle'] }} - {{ $data['model'] }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
