<div>
  <x-hero title="Home" />

  <x-container>
      <!-- Filters section -->
      <div class="mb-3">
          <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
              <div>
                  <h3 class="text-lg font-bold mb-2">Price Range</h3>
                  <!-- Price range filter dropdown -->
                  <select wire:model="selectedPriceRange" class="w-full border rounded-lg py-2 px-3">
                      <option value="">Select Price Range</option>
                      <option value="1">Under $50</option>
                      <option value="2">$50 - $100</option>
                      <option value="3">$100 - $200</option>
                      <!-- Add more options as needed -->
                  </select>
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
          @foreach ($products as $product)
              <div>
                  <a class="*:transition group" href="{{ $product->url }}" wire:navigate>
                      <div class="w-full h-48 mb-2 overflow-hidden border rounded-lg group-hover:brightness-90">
                          @if ($product->image_url)
                              <img class="object-cover w-full h-full" src="{{ $product->image_url }}" alt="{{ $product->name }}">
                          @else
                              <div class="flex items-center justify-center w-full h-full text-gray-400 bg-gray-200">
                                  Article
                              </div>
                          @endif
                      </div>

                      <h3 class="text-lg text-gray-700 group-hover:text-primary-500">{{ $product->name }}</h3>
                  </a>
              </div>
          @endforeach

          @empty($products)
              <div>No products yet.</div>
          @endempty
      </div>

      @if ($products->hasPages())
          <div class="pt-6 mt-6 border-t">
              {{ $products->links() }}
          </div>
      @endif
  </x-container>
</div>
