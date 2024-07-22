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

        {{-- Include the Hero component content --}}
        <div class=" mx-auto py-12 px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 ">
            <div class="lg:col-span-3">
                {{-- Carousel --}}
                <div x-data="{ currentSlide: 0 }" x-init="() => {
                    setInterval(() => {
                        currentSlide = (currentSlide + 1) % 3;
                    }, 3000);
                }">
                    {{-- Carousel slides --}}
                    <div x-show="currentSlide === 0">
                        <div class="mx-auto max-w-7xl lg:px-8">
                            <div
                                class="relative isolate overflow-hidden bg-red-800 px-6 pt-16 shadow-2xl sm:rounded-3xl sm:px-16 md:pt-24 lg:flex lg:gap-x-20 lg:px-24 lg:pt-0">
                                <svg viewBox="0 0 1024 1024"
                                    class="absolute left-1/2 top-1/2 -z-10 h-[64rem] w-[64rem] -translate-y-1/2 sm:left-full sm:-ml-80 lg:left-1/2 lg:ml-0 lg:-translate-x-1/2 lg:translate-y-0"
                                    aria-hidden="true">
                                    <circle cx="512" cy="512" r="512" fill="url(#gradient)"
                                        fill-opacity="0.7" />
                                    <defs>
                                        <radialGradient id="gradient">
                                            <stop stop-color="#3b82f6" />
                                            <stop offset="0.5" stop-color="#fbbf24" />
                                            <stop offset="1" stop-color="#ef4444" />
                                        </radialGradient>
                                    </defs>
                                </svg>
                                <div class="mx-auto max-w-md text-center lg:mx-0 lg:flex-auto lg:py-32 lg:text-left">
                                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                                        Affordable na Motor ba <br />
                                        hanap mo?
                                    </h2>
                                    <p class="mt-6 text-lg leading-8 text-gray-300">
                                        You can also download our Mobile App for online applications.
                                        Available only for android.
                                    </p>
                                    <div class="mt-10 flex items-center justify-center gap-x-6 lg:justify-start">
                                    </div>
                                </div>
                                <div class="relative mt-16 h-80 lg:mt-8">
                                    <img src="https://ndic.gov.ng/wp-content/uploads/2022/07/mobile-app-mockup.png"
                                        alt="App screenshot" />
                                </div>
                            </div>
                        </div>

                    </div>
                    <div x-show="currentSlide === 1">
                      <div class="mx-auto max-w-7xl lg:px-8">
                        <div
                            class="relative isolate overflow-hidden bg-yellow-800 px-6 pt-16 shadow-2xl sm:rounded-3xl sm:px-16 md:pt-24 lg:flex lg:gap-x-20 lg:px-24 lg:pt-0">
                            <svg viewBox="0 0 1024 1024"
                                class="absolute left-1/2 top-1/2 -z-10 h-[64rem] w-[64rem] -translate-y-1/2 sm:left-full sm:-ml-80 lg:left-1/2 lg:ml-0 lg:-translate-x-1/2 lg:translate-y-0"
                                aria-hidden="true">
                                <circle cx="512" cy="512" r="512" fill="url(#gradient)"
                                    fill-opacity="0.7" />
                                <defs>
                                    <radialGradient id="gradient">
                                        <stop stop-color="#3b82f6" />
                                        <stop offset="0.5" stop-color="#fbbf24" />
                                        <stop offset="1" stop-color="#ef4444" />
                                    </radialGradient>
                                </defs>
                            </svg>
                            <div class="mx-auto max-w-md text-center lg:mx-0 lg:flex-auto lg:py-32 lg:text-left">
                                <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                                    Affordable na Motor ba <br />
                                    hanap mo?
                                </h2>
                                <p class="mt-6 text-lg leading-8 text-gray-300">
                                    You can also download our Mobile App for online applications.
                                    Available only for android.
                                </p>
                                <div class="mt-10 flex items-center justify-center gap-x-6 lg:justify-start">
                                </div>
                            </div>
                            <div class="relative mt-16 h-80 lg:mt-8">
                                <img src="https://ndic.gov.ng/wp-content/uploads/2022/07/mobile-app-mockup.png"
                                    alt="App screenshot" />
                            </div>
                        </div>
                    </div>
                    </div>
                    <div x-show="currentSlide === 2">
                      <div class="mx-auto max-w-7xl lg:px-8">
                        <div
                            class="relative isolate overflow-hidden bg-yellow-600 px-6 pt-16 shadow-2xl sm:rounded-3xl sm:px-16 md:pt-24 lg:flex lg:gap-x-20 lg:px-24 lg:pt-0">
                            <svg viewBox="0 0 1024 1024"
                                class="absolute left-1/2 top-1/2 -z-10 h-[64rem] w-[64rem] -translate-y-1/2 sm:left-full sm:-ml-80 lg:left-1/2 lg:ml-0 lg:-translate-x-1/2 lg:translate-y-0"
                                aria-hidden="true">
                                <circle cx="512" cy="512" r="512" fill="url(#gradient)"
                                    fill-opacity="0.7" />
                                <defs>
                                    <radialGradient id="gradient">
                                        <stop stop-color="#3b82f6" />
                                        <stop offset="0.5" stop-color="#fbbf24" />
                                        <stop offset="1" stop-color="#ef4444" />
                                    </radialGradient>
                                </defs>
                            </svg>
                            <div class="mx-auto max-w-md text-center lg:mx-0 lg:flex-auto lg:py-32 lg:text-left">
                                <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                                    Affordable na Motor ba <br />
                                    hanap mo?
                                </h2>
                                <p class="mt-6 text-lg leading-8 text-gray-300">
                                    You can also download our Mobile App for online applications.
                                    Available only for android.
                                </p>
                                <div class="mt-10 flex items-center justify-center gap-x-6 lg:justify-start">
                                </div>
                            </div>
                            <div class="relative mt-16 h-80 lg:mt-8">
                                <img src="https://ndic.gov.ng/wp-content/uploads/2022/07/mobile-app-mockup.png"
                                    alt="App screenshot" />
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
           
</div>
