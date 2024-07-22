<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{ seo()->render() }}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.0/nouislider.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.0/nouislider.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('head')

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-base leading-normal tracking-normal text-gray-800">
    <div class="flex flex-col min-h-screen">
        <x-sections.header />

        <div class="flex-1">
            {{ $slot }}
        </div>

        <x-sections.footer />
    </div>

    @livewireScriptConfig
    @stack('scripts')
</body>

</html>
