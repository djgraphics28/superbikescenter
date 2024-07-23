@props([
    'title' => null,
    'afterTitle' => null,
])

<div>
    <h1 class="text-4xl">{{ $title ?? $slot }}</h1>

    @if ($afterTitle)
        <div class="mt-4">
            {{ $afterTitle }}
        </div>
    @endif
    <x-carousel />
    {{-- Include the Hero component content --}}
 
    </div>
