<x-mail::message>

Dear {{ $data['name'] }},

Thank you for inquiring with us. We have reviewed your inquiry, and the management has agreed to invite you to come to our office to proceed with your application. Before coming to our office, please make sure that you are already registered using the link provided below:

<x-mail::button :url="$data['link']">
    Click to register
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
