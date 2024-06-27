<div>
    <x-hero title="Customer Registration Form" />

    <x-container>

        <form wire:submit.prevent="submit">
            <div class="mb-3">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input wire:model.defer="first_name" type="text" id="first_name" name="first_name"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('first_name')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="middle_name" class="block text-sm font-medium text-gray-700">Middle Name</label>
                        <input wire:model.defer="middle_name" type="text" id="middle_name" name="middle_name"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('middle_name')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input wire:model.defer="last_name" type="text" id="last_name" name="last_name"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('last_name')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="sufix_name" class="block text-sm font-medium text-gray-700">Suffix Name</label>
                        <input wire:model.defer="sufix_name" type="text" id="sufix_name" name="sufix_name"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('sufix_name')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input wire:model.defer="username" type="text" id="username" name="username"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('username')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input wire:model.defer="email" type="email" id="email" name="email"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('email')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input wire:model.defer="password" type="password" id="password" name="password"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('password')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="contact_number" class="block text-sm font-medium text-gray-700">Contact
                            Number</label>
                        <input wire:model.defer="contact_number" type="text" id="contact_number"
                            name="contact_number"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('contact_number')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="birth_date" class="block text-sm font-medium text-gray-700">Birth Date</label>
                        <input wire:model.defer="birth_date" type="date" id="birth_date" name="birth_date"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('birth_date')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                        <select wire:model.defer="gender" id="gender" name="gender"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        @error('gender')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="marital_status" class="block text-sm font-medium text-gray-700">Marital
                            Status</label>
                        <select wire:model.defer="marital_status" id="marital_status" name="marital_status"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select Marital Status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                        @error('marital_status')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="province_id" class="block text-sm font-medium text-gray-700">Province</label>
                        <select wire:model.live="province_id" id="province_id" name="province_id"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Select Province</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->province_id }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                        @error('province_id')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="city_id" class="block text-sm font-medium text-gray-700">City</label>
                        <select wire:model.live="city_id" id="city_id" name="city_id"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Select City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->city_id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('city_id')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="barangay_id" class="block text-sm font-medium text-gray-700">Barangay</label>
                        <select wire:model="barangay_id" id="barangay_id" name="barangay_id"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="">Select Barangay</option>
                                    @foreach ($barangays as $barangay)
                                        <option value="{{ $barangay->id }}">{{ $barangay->name }}</option>
                                    @endforeach
                                </select>
                                @error('barangay_id')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="address1" class="block text-sm font-medium text-gray-700">Address Line 1</label>
                        <input wire:model.defer="address1" type="text" id="address1" name="address1"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('address1')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="address2" class="block text-sm font-medium text-gray-700">Address Line 2</label>
                        <input wire:model.defer="address2" type="text" id="address2" name="address2"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('address2')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Register
                </button>
            </div>
        </form>
    </x-container>

</div>
