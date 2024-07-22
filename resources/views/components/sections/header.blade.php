<div
    class="relative isolate flex items-center gap-x-6 overflow-hidden bg-gray-50 px-6 py-2.5 sm:px-3.5 sm:before:flex-1">
    <div class="absolute left-[max(-7rem,calc(50%-52rem))] top-1/2 -z-10 -translate-y-1/2 transform-gpu blur-2xl"
        aria-hidden="true">
        <div class="aspect-[577/310] w-[36.0625rem] bg-gradient-to-r from-[#ff80b5] to-[#9089fc] opacity-30"
            style="clip-path:polygon(74.8% 41.9%, 97.2% 73.2%, 100% 34.9%, 92.5% 0.4%, 87.5% 0%, 75% 28.6%, 58.5% 54.6%, 50.1% 56.8%, 46.9% 44%, 48.3% 17.4%, 24.7% 53.9%, 0% 27.9%, 11.9% 74.2%, 24.9% 54.1%, 68.6% 100%, 74.8% 41.9%)">
        </div>
    </div>
    <div class="absolute left-[max(45rem,calc(50%+8rem))] top-1/2 -z-10 -translate-y-1/2 transform-gpu blur-2xl"
        aria-hidden="true">
        <div class="aspect-[577/310] w-[36.0625rem] bg-gradient-to-r from-[#ff80b5] to-[#9089fc] opacity-30"
            style="clip-path:polygon(74.8% 41.9%, 97.2% 73.2%, 100% 34.9%, 92.5% 0.4%, 87.5% 0%, 75% 28.6%, 58.5% 54.6%, 50.1% 56.8%, 46.9% 44%, 48.3% 17.4%, 24.7% 53.9%, 0% 27.9%, 11.9% 74.2%, 24.9% 54.1%, 68.6% 100%, 74.8% 41.9%)">
        </div>
    </div>
    <div class="flex flex-wrap items-center gap-x-4 gap-y-2">
        <p class="text-sm leading-6 text-gray-900"><strong class="font-semibold">Superbikes</strong><svg
                viewBox="0 0 2 2" class="mx-2 inline h-0.5 w-0.5 fill-current" aria-hidden="true">
                <circle cx="1" cy="1" r="1"></circle>
            </svg>ANG MOTORCYCLE SHOP NG BAYAN – SULIT KA DITO!</p>
    </div>
    <div class="flex flex-1 justify-end"><button type="button"
            class="-m-3 p-3 focus-visible:outline-offset-[-4px]"><span class="sr-only">Dismiss</span>x</button></div>
</div>
<header class="text-white bg-white shadow">
    {{-- Top Navbar with Search --}}
    <x-container>
        <div class="w-full mx-auto flex flex-wrap items-center justify-between py-2 border-x-amber-50">
            <div class="pl-4 flex items-center">
                <a href="{{ route('home') }}"
                    class="text-white no-underline hover:no-underline font-bold text-2xl lg:text-3xl flex items-center">
                    <img class="w-50 h-16 mr-6" src="https://store.superbikescentral.online/images/superbikes_logo.png"
                        alt="Logo">
                </a>
            </div>

            {{-- Include your SearchBar Blade component or HTML here --}}

            <div class="block lg:hidden pr-4">
                <button id="nav-toggle"
                    class="flex items-center p-1 text-white hover:text-gray-300 focus:outline-none focus:shadow-outline">
                    <svg class="fill-current h-6 w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0zM0 7h20v2H0zM0 11h20v2H0z" />
                    </svg>
                </button>
            </div>

            {{-- Login and Register links --}}
            <div class="hidden lg:flex items-center space-x-4">
                <a href="#" class="text-blue-900 no-underline hover:underline font-bold">Login</a>
                <a href="#" class="text-blue-900 no-underline hover:underline font-bold">Register</a>
            </div>
        </div>
    </x-container>

    {{-- Second Navbar with Navigation Links --}}
    <div class="w-full bg-blue-900 mx-auto flex flex-wrap items-center justify-center py-2">
        <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-blue text-black p-4 lg:p-0 z-20"
            id="nav-content">
            <ul class="list-reset lg:flex justify-center flex-1 items-center">
                <li class="mr-3">
                    <a href="{{ route('home') }}" wire:navigate
                        class="inline-block py-2 px-4 text-white no-underline hover:text-gray-300 hover:text-underline font-bold">Home</a>
                </li>
                <li class="mr-3">
                    <a href="{{ route('motorcycles.index') }}" wire:navigate
                        class="inline-block py-2 px-4 text-white no-underline hover:text-gray-300 hover:text-underline font-bold">Motorcycles</a>
                </li>
                <li class="mr-3">
                    <a href="#" wire:navigate
                        class="inline-block py-2 px-4 text-white no-underline hover:text-gray-300 hover:text-underline font-bold">About</a>
                </li>
                <li class="mr-3">
                    <a href="#" wire:navigate
                        class="inline-block py-2 px-4 text-white no-underline hover:text-gray-300 hover:text-underline font-bold">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</header>
