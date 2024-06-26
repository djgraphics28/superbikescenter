<div x-data="{ selectedVariation: '{{ $product->image_url }}', selectedVariationId: null, showForm: false }">
    <div class="hidden bg-black md:block bg-opacity-90">
        <x-container>
            {{ Breadcrumbs::render('product', $product) }}
        </x-container>
    </div>

    <article>
        <x-hero :title="$product->name">
            @slot('afterTitle')
                <div class="inline-flex items-center text-xs cursor-help"
                    x-tooltip.raw="{{ $product->created_at->format('F j, Y') }}">
                    <x-heroicon-o-calendar class="w-3 h-3 mr-1" />
                    <time datetime="{{ $product->created_at->format('Y-m-d H:i:s') }}">
                        {{ $product->created_at->diffForHumans() }}
                    </time>
                </div>
            @endslot
        </x-hero>
        <x-container>
            <div class="flex flex-col md:flex-row">
                <div class="prose md:w-1/2">
                    <figure class="w-200">
                        <img :src="selectedVariation" :alt="$product - > name" />
                        <figcaption>{{ $product->name }}</figcaption>
                    </figure>
                </div>
                <div class="md:w-1/2 md:ml-8">
                    <h2>Description</h2>
                    <p>{!! $product->description !!}</p>
                    <div class="mt-4">
                        <h3>Variation Selection</h3>
                        <div class="flex space-x-4">
                            @foreach ($product->variations as $variation)
                                <label class="cursor-pointer">
                                    <input type="radio" name="variation" value="{{ $variation->id }}" class="hidden"
                                        @change="selectedVariation = '{{ $variation->image_url }}'; selectedVariationId = '{{ $variation->id }}'">
                                    <img :src="'{{ $variation->image_url }}'" :alt="'{{ $variation->name }}'"
                                        :class="{ 'border-blue-500': selectedVariationId === '{{ $variation->id }}' }"
                                        class="w-16 h-16 border-2 border-transparent hover:border-blue-500">
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3>Price Details</h3>
                        <p>{{ $product->price }}</p>
                    </div>
                    <div class="mt-4">
                        <button @click="showForm = true" class="px-4 py-2 bg-blue-500 text-white rounded">
                            Inquire
                        </button>
                    </div>
                    <div x-show="showForm" class="mt-4">
                        <form wire:submit.prevent="submitInquiry">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                    Name
                                </label>
                                <input wire:model="name"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="name" type="text" placeholder="Your name">
                                @error('name')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                                    Email
                                </label>
                                <input wire:model="email"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="email" type="email" placeholder="Your email">
                                @error('email')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="contact">
                                    Contact Number
                                </label>
                                <input wire:model="contact_number"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="contact" type="text" placeholder="Your contact number">
                                @error('contact_number')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                              <label for="province" class="block text-gray-700 text-sm font-bold mb-2">Province</label>
                              <select wire:model.live="province" id="province" name="province" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                  <option value="">Select Province</option>
                                  @foreach($provinces as $province)
                                      <option value="{{ $province->province_id }}">{{ $province->name }}</option>
                                  @endforeach
                              </select>
                              @error('province') <span class="text-red-500">{{ $message }}</span> @enderror
                          </div>

                          <div class="mb-4">
                              <label for="city" class="block text-gray-700 text-sm font-bold mb-2">City</label>
                              <select wire:model.live="city" id="city" name="city" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                  <option value="">Select City</option>
                                  @foreach($cities as $city)
                                      <option value="{{ $city->city_id }}">{{ $city->name }}</option>
                                  @endforeach
                              </select>
                              @error('city') <span class="text-red-500">{{ $message }}</span> @enderror
                          </div>

                          <div class="mb-4">
                              <label for="barangay" class="block text-gray-700 text-sm font-bold mb-2">Barangay</label>
                              <select wire:model="barangay" id="barangay" name="barangay" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                  <option value="">Select Barangay</option>
                                  @foreach($barangays as $barangay)
                                      <option value="{{ $barangay->id }}">{{ $barangay->name }}</option>
                                  @endforeach
                              </select>
                              @error('barangay') <span class="text-red-500">{{ $message }}</span> @enderror
                          </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="message">
                                    Message
                                </label>
                                <textarea wire:model="message" id="message"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Your message"></textarea>
                                @error('message')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <button class="px-4 py-2 bg-blue-500 text-white rounded">
                                    Submit Inquiry
                                </button>
                            </div>
                        </form>

                        <!-- Success message -->
                        <div x-data="{ show: @entangle('showSuccessMessage') }" x-init="() => { $watch('show', value => { if (value) { setTimeout(() => show = false, @this.get('successMessageDelay')) } }) }"
                            x-show.transition.out.duration.1000ms="show"
                            class="bg-green-200 text-green-800 rounded p-3 mt-3">
                            {{ session('success') }}
                            <button @click="show = false" class="float-right">&times;</button>
                        </div>
                    </div>
                </div>
            </div>
        </x-container>
    </article>
</div>
