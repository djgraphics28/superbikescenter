<x-mail::message>
# Welcome to SuperBikesCenter!

Hi {{ $data['first_name'] }},

Thank you for registering with SuperBikesCenter Motorshop! We're excited to have you as a part of our community. You can now enjoy all the benefits of being a member, including exclusive offers, updates, and more.

Here is your credentials:

username: {{ $data['username'] }} <br>
password: {{ $data['unhashedPass'] }}

<x-mail::button :url="route('home')">
Login to Your Account
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
