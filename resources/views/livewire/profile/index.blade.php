<div>
    <x-container>
        <div class="space-y-4">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">First Name</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $profile->first_name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $profile->middle_name ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Last Name</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $profile->last_name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Suffix Name</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $profile->sufix_name ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $profile->contact_number }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Birth Date</label>
                    <p class="mt-1 text-sm text-gray-900">
                        {{ \Carbon\Carbon::parse($profile->birth_date)->format('F j, Y') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Gender</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $profile->gender }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Marital Status</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $profile->marital_status }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Province</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $profile->province->name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">City</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $profile->city->name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Barangay</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $profile->barangay->name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Address 1</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $profile->address1 }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Address 2</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $profile->address2 ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </x-container>

</div>
