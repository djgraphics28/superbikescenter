<x-mail::message>
# Hi {{ $data['name'] }},

Thank you for reaching out to us. We have received your message and will get back to you shortly.

<x-mail::button :url="config('app.url')">
Visit Our Website
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
