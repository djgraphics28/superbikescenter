<header class="text-white bg-white shadow">
    {{-- Top Navbar with Search --}}
    <x-container>

      <div class="w-full  mx-auto flex flex-wrap items-center justify-between py-2 border-x-amber-50">
          <div class="pl-4 flex items-center">
              <a href="{{ route('home') }}" class="text-white no-underline hover:no-underline font-bold text-2xl lg:text-3xl flex items-center">
                  <img class="w-32 h-16 mr-6" src="https://store.superbikescentral.online/images/superbikes_logo.png" alt="Logo">
              </a>
          </div>

          {{-- Include your SearchBar Blade component or HTML here --}}

          <div class="block lg:hidden pr-4">
              <button id="nav-toggle" class="flex items-center p-1 text-white hover:text-gray-300 focus:outline-none focus:shadow-outline">
                  <svg class="fill-current h-6 w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <title>Menu</title>
                      <path d="M0 3h20v2H0zM0 7h20v2H0zM0 11h20v2H0z" />
                  </svg>
              </button>
          </div>
      </div>
    </x-container>

    {{-- Second Navbar with Navigation Links --}}
    <div class="w-full  bg-blue-900  mx-auto flex flex-wrap items-center justify-center py-2">
        <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-blue text-black p-4 lg:p-0 z-20" id="nav-content">
            <ul class="list-reset lg:flex justify-center flex-1 items-center">
                <li class="mr-3">
                    <a href="{{ route('home') }}" class="inline-block py-2 px-4 text-white no-underline hover:text-gray-300 hover:text-underline font-bold">Home</a>
                </li>
                <li class="mr-3">
                    <a href="/" class="inline-block py-2 px-4 text-white no-underline hover:text-gray-300 hover:text-underline font-bold">Motorcycles</a>
                </li>
                <li class="mr-3">
                    <a href="#" class="inline-block py-2 px-4 text-white no-underline hover:text-gray-300 hover:text-underline font-bold">About</a>
                </li>
                <li class="mr-3">
                    <a href="#" class="inline-block py-2 px-4 text-white no-underline hover:text-gray-300 hover:text-underline font-bold">Contact</a>
                </li>
                <li class="mr-3">
                    <a href="#" class="inline-block py-2 px-4 text-white no-underline hover:text-gray-300 hover:text-underline font-bold">Shop</a>
                </li>
                <li class="mr-3">
                    <a href="#" class="inline-block py-2 px-4 text-white no-underline hover:text-gray-300 hover:text-underline font-bold">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

</header>
