<div>
    <x-hero title="Home" />

    <x-container>
        <!-- Filters section -->
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

        <!-- Product listing section -->
        <h2 class="mb-8 text-4xl">Latest Products</h2>
        <div wire:loading>Loading...</div>
        <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($products as $product)
                <div>
                    <a class="*:transition group" href="{{ $product->url }}" wire:navigate>
                        <div class="w-full h-48 mb-2 overflow-hidden border rounded-lg group-hover:brightness-90">
                            @if ($product->image_url)
                                <img class="object-cover w-full h-full" src="{{ $product->image_url }}"
                                    alt="{{ $product->name }}">
                            @else
                                <div class="flex items-center justify-center w-full h-full text-gray-400 bg-gray-200">
                                    Product Image
                                </div>
                            @endif
                        </div>

                        <h3 class="text-lg text-gray-700 group-hover:text-primary-500">{{ $product->name }}</h3>
                        <h3 class="text-lg text-gray-700 group-hover:text-primary-500">Regular Price: Php
                            {{ number_format($product->price, 2) }}</h3>
                        <div class="inline-flex items-center px-3 py-1 bg-red-500 text-white rounded-1/2">
                            <span class="text-xs font-semibold mr-2">Installment Price</span>
                            <h3 class="text-lg text-white group-hover:text-white">Php
                                {{ number_format($product->price / 36, 2) }}</h3>
                        </div>

                    </a>
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
