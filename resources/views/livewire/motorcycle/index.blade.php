<div>
    <x-container>
        <div class="flex flex-wrap">
            <!-- Filters Section -->
            <div class="w-full md:w-1/4 bg-gray-100 p-4 mb-4">
                <form wire:submit.prevent="render">
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Category Filter -->
                        <div>
                            <label for="category" class="block text-gray-700 font-bold mb-2">Category</label>
                            <select wire:model="selectedCategory" id="category"
                                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Brand Filter -->
                        <div>
                            <label for="brand" class="block text-gray-700 font-bold mb-2">Brand</label>
                            <select wire:model="selectedBrand" id="brand"
                                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">All Brands</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price Filter -->
                        <div>
                            <label for="price" class="block text-gray-700 font-bold mb-2">Price</label>
                            <select wire:model="selectedPrice" id="price"
                                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">All Prices</option>
                                <option value="0-5000">Php 0 - Php 5000</option>
                                <option value="5001-10000">Php 5001 - Php 10000</option>
                                <option value="10001-20000">Php 10001 - Php 20000</option>
                                <option value="20001-50000">Php 20001 - Php 50000</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Motorcycle List Section -->
            <div class="w-full md:w-3/4 p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($motorcycles as $motorcycle)
                        <div class="bg-white shadow-md rounded p-4">
                            <img src="{{ $motorcycle->image_url }}" alt="motorcycle model"
                                class="transition-transform duration-700 ease-in-out group-hover:scale-105">
                            <h3 class="text-xl font-bold mb-2">{{ $motorcycle->name }}</h3>
                            <p class="text-gray-700">Category: {{ $motorcycle->category->name }}</p>
                            <p class="text-gray-700">Brand: {{ $motorcycle->brand->name }}</p>
                            <p class="text-gray-700">Price: Php {{ number_format($motorcycle->price, 2) }}</p>
                        </div>
                    @empty
                        <div class="col-span-3 text-center">
                            <p class="text-gray-700">No motorcycles found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </x-container>
</div>
