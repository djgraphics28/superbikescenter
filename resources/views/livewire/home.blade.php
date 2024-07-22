<div>
    <x-hero title="" />
    <div class="bg-primary-blue-100 py-12 sm:py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <dl class="grid grid-cols-1 gap-x-8 gap-y-16 text-center lg:grid-cols-3">
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base leading-7 text-gray-600">
                        Ang Motorcycle Shop ng Bayan. At your doorstep!
                    </dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-3xl">
                        Door to door Deliviery
                    </dd>
                </div>
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base leading-7 text-gray-600">
                        Apply motorcycle loan via Superbikes App
                    </dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-3xl">
                        Online Application
                    </dd>
                </div>
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base leading-7 text-gray-600">
                        Pay via Maya App and GCash (thru Dragon Loans)
                    </dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-3xl">
                        Pay Dues Online
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <x-container class="">
        <!-- Filters section -->
        <div class="">
            <div class="">
                <h1 class="text-5xl font-extrabold">Featured</h1>
                <p>Explore motorcycles you might like</p>
            </div>
            <div class="mb-3">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                    <div>
                        <div wire:ignore>
                            <h3 class="text-lg font-bold mb-2">Price Range</h3>
                            <div id="slider" class="mb-4"></div>
                            <input wire:model.live="minPrice" type="hidden" id="min_price" name="min_price">
                            <input wire:model.live="maxPrice" type="hidden" id="max_price" name="max_price">
                        </div>
                        <span>Php {{ $minPrice }} - Php {{ $maxPrice }}</span>

                    </div>

                    <div>
                        <h3 class="text-lg font-bold mb-2">Brand</h3>
                        <!-- Brand filter dropdown -->
                        <select wire:model.live="selectedBrand" class="w-full border rounded-lg py-2 px-3">
                            <option value="">Select Brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold mb-2">Category</h3>
                        <!-- Category filter dropdown -->
                        <select wire:model.live="selectedCategory" class="w-full border rounded-lg py-2 px-3">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product listing section -->

        <div wire:loading>Loading...</div>
        <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-3">

            @forelse ($products as $product)
                <div class="motorcycle-card rounded group bg-white shadow-md p-6">
                    <div class="motorcycle-card__content">
                        <h2 class="motorcycle-card__content-title">{{ $product->name }}</h2>
                    </div>
                    <p class="flex mt-6 text-[32px] leading-[38px] text-blue-800 font-extrabold">
                        Php {{ number_format($product->price, 2) }}</p>
                    <div class="motorcycle-card__btn-container mx-auto ">
                        <div class="inline-flex items-center px-3 py-1 bg-red-500 text-white rounded-1/2">
                            <span class="text-xs font-semibold mr-2">Installment Price</span>
                            <h3 class="text-lg text-white group-hover:text-white">Php
                                {{ number_format($product->price / 36, 2) }}</h3>
                        </div>
                    </div>
                    <div class="relative w-full h-[250px] my-3 overflow-hidden " href="{{ $product->url }} "
                        wire:navigate><img src="{{ $product->image_url }}" alt="motorcycle model"
                            class="transition-transform duration-700 ease-in-out group-hover:scale-105"></div>
                    <div class="relative flex mx-auto w-full">
                        <div class="motorcycle-card__btn-container mx-auto "><button type="button"
                                class="custom-btn w-full py-[8px] rounded-full bg-blue-900  mx-auto "><span
                                    class="flex-1 text-white text-[14px] leading-[12px] font-bold px-6"
                                    href="{{ $product->url }}" wire:navigate>View More</span>
                            </button></div>
                    </div>
                </div>
            @empty
                <p>No Motors found</p>
            @endforelse
        </div>

        @if ($products->hasPages())
            <div class="pt-6 mt-6 border-t">
                {{ $products->links() }}
            </div>
        @endif
    </x-container>

    <div class="bg-primary-blue-100 mt-12">
        <div class="mx-auto max-w-7xl py-12 sm:px-6 sm:py-12 lg:px-8">
            <div
                class="relative isolate overflow-hidden bg-blue-900 px-6 pt-16 shadow-2xl sm:rounded-3xl sm:px-16 md:pt-24 lg:flex lg:gap-x-20 lg:px-24 lg:pt-0">
                <svg viewBox="0 0 1024 1024"
                    class="absolute left-1/2 top-1/2 -z-10 h-[64rem] w-[64rem] -translate-y-1/2 [mask-image:radial-gradient(closest-side,white,transparent)] sm:left-full sm:-ml-80 lg:left-1/2 lg:ml-0 lg:-translate-x-1/2 lg:translate-y-0"
                    aria-hidden="true">
                    <circle cx="512" cy="512" r="512" fill="url(#759c1415-0410-454c-8f7c-9a820de03641)"
                        fill-opacity="0.7"></circle>
                    <defs>
                        <radialGradient id="759c1415-0410-454c-8f7c-9a820de03641">
                            <stop stop-color="#3b82f6"></stop>
                            <stop offset="0.5" stop-color="#fbbf24"></stop>
                            <stop offset="1" stop-color="#ef4444"></stop>
                        </radialGradient>
                    </defs>
                </svg>
                <div class="mx-auto max-w-md text-center lg:mx-0 lg:flex-auto lg:py-32 lg:text-left">
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Affordable na Motor ba
                        <br>hanap mo?
                    </h2>
                    <p class="mt-6 text-lg leading-8 text-gray-300">You can also download our Mobile App for online
                        applications. Available only for android.</p>
                    <div class="mt-10 flex items-center justify-center gap-x-6 lg:justify-start"><button type="button"
                            class="custom-btn w-full py-[16px] rounded-full bg-red-600"><span
                                class="flex-1 text-white text-[14px] leading-[17px] font-bold">Download Now</span>

                        </button></div>
                </div>
                <div class="relative mt-16 h-80 lg:mt-8"><img class=""
                        src="https://ndic.gov.ng/wp-content/uploads/2022/07/mobile-app-mockup.png" alt="App screenshot">
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <h2 class="text-center text-lg font-semibold leading-8 text-gray-900">Our Trusted Partners</h2>
            <div
                class="mx-auto mt-10 grid max-w-lg grid-cols-4 items-center gap-x-8 gap-y-10 sm:max-w-xl sm:grid-cols-6 sm:gap-x-10 lg:mx-0 lg:max-w-none lg:grid-cols-4">
                <img class="col-span-3 max-h-24 w-full object-contain lg:col-span-1"
                    src="https://motorlandia.com.ph/wp-content/uploads/2022/10/Suzuki.png" alt="Transistor"><img
                    class="col-span-3 max-h-24 w-full object-contain lg:col-span-1"
                    src="https://motorlandia.com.ph/wp-content/uploads/2022/10/Honda.png" alt="Reform"><img
                    class="col-span-3 max-h-24 w-full object-contain lg:col-span-1"
                    src="https://motorlandia.com.ph/wp-content/uploads/2022/10/Kawasaki.png" alt="Tuple"><img
                    class="col-span-3 max-h-24 w-full object-contain sm:col-start-2 lg:col-span-1"
                    src="https://motorlandia.com.ph/wp-content/uploads/2022/10/Yamaha.png" alt="SavvyCal">
            </div>
        </div>
    </div>
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
