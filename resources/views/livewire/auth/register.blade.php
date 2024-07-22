<div>
    <x-container>
        <div class="min-h-screen flex justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-6">Register</h2>

                    @if (session()->has('success'))
                        <div class="bg-green-500 text-white p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="register">
                        @csrf
                        <div class="mb-4">
                            <label for="first_name" class="block text-gray-700 font-bold mb-2">First Name</label>
                            <input type="text" wire:model="first_name" id="first_name"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('first_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="middle_name" class="block text-gray-700 font-bold mb-2">Middle Name</label>
                            <input type="text" wire:model="middle_name" id="middle_name"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('middle_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="last_name" class="block text-gray-700 font-bold mb-2">Last Name</label>
                            <input type="text" wire:model="last_name" id="last_name"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('last_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="sufix_name" class="block text-gray-700 font-bold mb-2">Suffix Name</label>
                            <input type="text" wire:model="sufix_name" id="sufix_name"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('sufix_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="contact_number" class="block text-gray-700 font-bold mb-2">Contact
                                Number</label>
                            <input type="text" wire:model="contact_number" id="contact_number"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('contact_number')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="birth_date" class="block text-gray-700 font-bold mb-2">Birth Date</label>
                            <input type="date" wire:model="birth_date" id="birth_date"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('birth_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="gender" class="block text-gray-700 font-bold mb-2">Gender</label>
                            <select wire:model="gender" id="gender"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            @error('gender')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="marital_status" class="block text-gray-700 font-bold mb-2">Marital
                                Status</label>
                            <select wire:model="marital_status" id="marital_status"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Select Marital Status</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Divorced">Divorced</option>
                            </select>

                            @error('marital_status')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="province_id" class="block text-gray-700 font-bold mb-2">Province</label>
                            <select wire:model.live="province_id" id="province_id"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Select Province</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->province_id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                            @error('province_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="city_id" class="block text-gray-700 font-bold mb-2">City</label>
                            <select wire:model.live="city_id" id="city_id"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                {{ !$province_id ? 'disabled' : '' }}>
                                <option value="">Select City</option>
                                @if ($province_id)
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->city_id }}">{{ $city->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('city_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="barangay_id" class="block text-gray-700 font-bold mb-2">Barangay</label>
                            <select wire:model.live="barangay_id" id="barangay_id"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                {{ !$city_id ? 'disabled' : '' }}>
                                <option value="">Select Barangay</option>
                                @if ($city_id)
                                    @foreach ($barangays as $barangay)
                                        <option value="{{ $barangay->id }}">{{ $barangay->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('barangay_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="address1" class="block text-gray-700 font-bold mb-2">Address 1</label>
                            <input type="text" wire:model="address1" id="address1"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('address1')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="address2" class="block text-gray-700 font-bold mb-2">Address 2</label>
                            <input type="text" wire:model="address2" id="address2"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('address2')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                            <input type="email" wire:model="email" id="email"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('email')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                            <input type="password" wire:model="password" id="password"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('password')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Confirm
                                Password</label>
                            <input type="password" wire:model="password_confirmation" id="password_confirmation"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('password_confirmation')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-container>
</div>
