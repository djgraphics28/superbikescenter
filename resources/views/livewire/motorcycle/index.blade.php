<div>
    <h1 class="text-2xl max-w-screen-xl mx-auto border-b py-8 font-bold">Motorcycles</h1>
    <main class="flex max-w-screen-xl  mx-auto">
        <div class="w-1/4 px-4 py-8 border-r">
            <h2 class="text-lg font-semibold mb-4">Filters</h2>
            <div class="p-4 w-full">
              <input wire:model.live="search" placeholder="Search ..." type="text" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="p-4 w-full"><label class="block mb-2">Select a category:</label>
                <select wire:model.live="selectedCategory" id="category"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="p-4 w-full"><label class="block mb-2">Select a manufacturer:</label>
                <select wire:model.live="selectedBrand" id="brand"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">All Brands</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="p-4 w-full">
                <div wire:ignore>
                    <h3 class="text-lg font-bold mb-2">Price Range</h3>
                    <div id="slider" class="mb-4"></div>
                    <input wire:model.live="minPrice" type="hidden" id="min_price" name="min_price">
                    <input wire:model.live="maxPrice" type="hidden" id="max_price" name="max_price">
                </div>
                <span>Php {{ $minPrice }} - Php {{ $maxPrice }}</span>

            </div>
        </div>
        <div class="w-3/4 px-4 py-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6 mt-6">
                @forelse($products as $product)
                    <div class="flex flex-col mb-4">
                        <div class="motorcycle-card group shadow-md p-6">
                            <div class="motorcycle-card__content">
                                <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                            </div>
                            <p class="text-red-800 text-sm">{{ $product->brand->name }}</p>
                            <p class="text-gray-800 text-sm">{{ $product->category->name }}</p>
                            <p class="flex mt-2 text-[24px] leading-[38px] text-blue-800 font-bold">
                                ₱{{ number_format($product->price, 2) }}</p>
                            <div class="relative w-full h-[250px] my-3 overflow-hidden "><img
                                    src="{{ $product->image_url }}" alt="motorcycle model"
                                    class="transition-transform duration-700 ease-in-out group-hover:scale-105"></div>
                            <div class="relative mx-auto  flex w-full">
                                <div class="w-full flex mx-auto ">
                                    <a type="button" href="product/{{ $product->slug }}"
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

                <div class="pt-6 mt-6 border-t">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </main>
</div>

@push('scripts')
    <script>
        var slider = document.getElementById('slider');
        noUiSlider.create(slider, {
            start: [0, 300000],
            connect: true,
            range: {
                'min': 0,
                'max': 300000
            },
            step: 5000, // To have 100, 200, 300 steps
            format: {
                to: function(value) {
                    return Math.round(value);
                },
                from: function(value) {
                    return Number(value);
                }
            }

        });

        var minPrice = document.getElementById('min_price');
        var maxPrice = document.getElementById('max_price');

        slider.noUiSlider.on('update', function(values, handle) {
            // console.log(values);
            if (handle) {
                maxPrice.value = values[handle];
                @this.set('maxPrice', values[handle]);
            } else {
                minPrice.value = values[handle];
                @this.set('minPrice', values[handle]);
            }

            $('#minMaxValue').text(values[handle]);
        });
    </script>
@endpush
