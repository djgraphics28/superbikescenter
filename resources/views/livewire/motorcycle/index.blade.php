<div>
    <h1 class="text-2xl max-w-screen-xl mx-auto border-b py-8 font-bold">Motorcycles</h1>
    <main class="flex max-w-screen-xl  mx-auto">
        <div class="w-1/4 px-4 py-8 border-r">
            <h2 class="text-lg font-semibold mb-4">Filters</h2>
            <div class="p-4 w-full"><label class="block mb-2">Select a category:</label>
                <select wire:model="selectedCategory" id="category"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="p-4 w-full"><label class="block mb-2">Select a manufacturer:</label>
                <select wire:model="selectedBrand" id="brand"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">All Brands</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="w-3/4 px-4 py-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6 mt-6">
                @forelse($motorcycles as $motorcycle)
                    {{-- <div class="bg-white shadow-md rounded p-4">
                    <img src="{{ $motorcycle->image_url }}" alt="motorcycle model"
                        class="transition-transform duration-700 ease-in-out group-hover:scale-105">
                    <h3 class="text-xl font-bold mb-2">{{ $motorcycle->name }}</h3>
                    <p class="text-gray-700">Category: {{ $motorcycle->category->name }}</p>
                    <p class="text-gray-700">Brand: {{ $motorcycle->brand->name }}</p>
                    <p class="text-gray-700">Price: Php {{ number_format($motorcycle->price, 2) }}</p>
                </div>
 --}}

                    <div class="flex flex-col mb-4">
                        <div class="motorcycle-card group shadow-md p-6">
                            <div class="motorcycle-card__content">
                                <h2 class="text-lg font-semibold">{{ $motorcycle->name }}</h2>
                            </div>
                            <p class="text-red-800 text-sm">{{ $motorcycle->brand->name }}</p>
                            <p class="text-gray-800 text-sm">{{ $motorcycle->category->name }}</p>
                            <p class="flex mt-2 text-[24px] leading-[38px] text-blue-800 font-bold">
                                ₱{{ number_format($motorcycle->price, 2) }}</p>
                            <div class="relative w-full h-[250px] my-3 overflow-hidden "><img
                                    src="{{ $motorcycle->image_url }}" alt="motorcycle model"
                                    class="transition-transform duration-700 ease-in-out group-hover:scale-105"></div>
                            {{-- <div class="flex flex-col items-start mt-4 mb-6">
                            <p class="text-sm text-gray-700">3 variations:</p>
                            <div class="flex space-x-2 mt-2">
                                <div class="relative w-8 h-8 border rounded overflow-hidden"><img
                                        src="https://superbikescentral.online/storage/01J19NW2WM9RRABKRGM0WJ8MCZ.jpg"
                                        alt="HONDA ADV 160 in black" class="rounded"></div>
                                <div class="relative w-8 h-8 border rounded overflow-hidden"><img
                                        src="https://superbikescentral.online/storage/01J19NW2WP87JHY4B9Q7ZEGW9Z.jpg"
                                        alt="HONDA ADV 160 in white" class="rounded"></div>
                                <div class="relative w-8 h-8 border rounded overflow-hidden"><img
                                        src="https://superbikescentral.online/storage/01J19NW2WQ4BERA5TA1566HRSS.jpg"
                                        alt="HONDA ADV 160 in red" class="rounded"></div>
                            </div>
                        </div> --}}
                            <div class="relative mx-auto  flex w-full">
                                <div class="w-full flex mx-auto ">
                                    <a type="button"
                                        href="product/{{$motorcycle->slug}}"
                                        class="mx-auto  py-2 px-4 w-full py-auto rounded-full flex bg-blue-900">
                                        <span class="flex-1 ml-4 text-white  leading-[17px] ">View More
                                        </span>
                                        <div class="relative w-6 h-6 text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                            </svg>

                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                @empty
                    <div class="col-span-3 text-center">
                        <p class="text-gray-700">No motorcycles found.</p>
                    </div>
                @endforelse


            </div>
        </div>
</div>
</main>
</div>
