<div x-data="{ selectedVariation: '{{ $product->image_url }}', selectedVariationId: null, showForm: false }">
    <div class="hidden  text-gray md:block bg-opacity-90">
        <x-container>
            {{ Breadcrumbs::render('product', $product) }}
        </x-container>
    </div>

    <article>
        <x-container class="mt-9">
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
                        <h3 class="text-lg text-gray-700 group-hover:text-primary-500">Regular Price: Php
                            {{ number_format($product->price, 2) }}</h3>
                        <div class="inline-flex items-center px-3 py-1 bg-red-500 text-white rounded-1/2">
                            <span class="text-xs font-semibold mr-2">Installment Price</span>
                            <h3 class="text-lg text-white group-hover:text-white">Php
                                {{ number_format($product->price / 36, 2) }}</h3>
                        </div>
                    </div>
                    <div class="mt-4">
                        <!-- Modified button to open modal -->
                        <button @click="showForm = true"
                            class="px-4 py-2 bg-blue-500 text-white rounded cursor-pointer">
                            Inquire
                        </button>
                    </div>
                </div>
            </div>
        </x-container>
    </article>

    <!-- Modal -->
    <div x-show="showForm" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-lg shadow-xl w-full md:max-w-md mx-auto relative">
                <div class="absolute top-2 right-2">
                    <button @click="showForm = false" class="text-gray-600 hover:text-gray-900">
                        <!-- Close button icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="py-4 px-6">
                    <div class="mb-4">
                        <h2 class="text-xl font-bold">Inquiry Form</h2>
                    </div>
                    <form wire:submit.prevent="submitInquiry">
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                            <input wire:model="name"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="name" type="text" placeholder="Your name">
                            @error('name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                            <input wire:model="email"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="email" type="email" placeholder="Your email">
                            @error('email')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="contact" class="block text-gray-700 text-sm font-bold mb-2">Contact
                                Number</label>
                            <input wire:model="contact_number"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="contact" type="text" placeholder="Your contact number">
                            @error('contact_number')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="province" class="block text-gray-700 text-sm font-bold mb-2">Province</label>
                            <select wire:model.live="province" id="province" name="province"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Select Province</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->province_id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                            @error('province')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="city" class="block text-gray-700 text-sm font-bold mb-2">City</label>
                            <select wire:model.live="city" id="city" name="city"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Select City</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->city_id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                            @error('city')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="barangay" class="block text-gray-700 text-sm font-bold mb-2">Barangay</label>
                            <select wire:model="barangay" id="barangay" name="barangay"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Select Barangay</option>
                                @foreach ($barangays as $barangay)
                                    <option value="{{ $barangay->id }}">{{ $barangay->name }}</option>
                                @endforeach
                            </select>
                            @error('barangay')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Message</label>
                            <textarea wire:model="message" id="message"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Your message"></textarea>
                            @error('message')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded cursor-pointer">
                                Submit Inquiry
                            </button>
                        </div>
                    </form>
                    <!-- Success message -->
                    <div x-data="{ show: @entangle('showSuccessMessage') }" x-show.transition.out.duration.1000ms="show"
                        class="bg-green-200 text-green-800 rounded p-3 mt-3">
                        {{ session('success') }}
                        <button @click="show = false" class="float-right">&times;</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div x-show="showForm" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-lg shadow-xl w-full md:max-w-md mx-auto relative">
                <div class="absolute top-2 right-2">
                    <button @click="showForm = false" class="text-gray-600 hover:text-gray-900">
                        <!-- Close button icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="py-4 px-6">
                    <div class="mb-4">
                        <h2 class="text-xl font-bold">Inquiry Form</h2>
                    </div>

                    <!-- Success message -->
                    <div x-data="{ show: @entangle('showSuccessMessage') }" x-show.transition.out.duration.1000ms="show"
                        class="bg-green-200 text-green-800 rounded p-3 mt-3">
                        Inquiry Submitted Successfully!
                        <button @click="show = false" class="float-right">&times;</button>
                    </div>

                    <form wire:submit.prevent="submitInquiry">
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                            <input wire:model="name"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="name" type="text" placeholder="Your name">
                            @error('name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                            <input wire:model="email"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="email" type="email" placeholder="Your email">
                            @error('email')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="contact" class="block text-gray-700 text-sm font-bold mb-2">Contact
                                Number</label>
                            <input wire:model="contact_number"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="contact" type="text" placeholder="Your contact number">
                            @error('contact_number')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="province" class="block text-gray-700 text-sm font-bold mb-2">Province</label>
                            <select wire:model.live="province" id="province" name="province"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Select Province</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->province_id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                            @error('province')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="city" class="block text-gray-700 text-sm font-bold mb-2">City</label>
                            <select wire:model.live="city" id="city" name="city"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Select City</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->city_id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                            @error('city')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="barangay" class="block text-gray-700 text-sm font-bold mb-2">Barangay</label>
                            <select wire:model="barangay" id="barangay" name="barangay"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Select Barangay</option>
                                @foreach ($barangays as $barangay)
                                    <option value="{{ $barangay->id }}">{{ $barangay->name }}</option>
                                @endforeach
                            </select>
                            @error('barangay')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Message</label>
                            <textarea wire:model="message" id="message"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Your message"></textarea>
                            @error('message')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <button {{ $loading ? 'disabled' : '' }} type="submit" class="px-4 py-2 bg-blue-500 text-white rounded cursor-pointer w-full">
                                <span wire:loading.remove wire:target="submitInquiry">Submit Inquiry</span>
                                <span wire:loading wire:target="submitInquiry">Loading...</span>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- End Modal -->
</div>
