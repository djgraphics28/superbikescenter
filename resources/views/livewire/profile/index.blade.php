<div>
    <x-container>
        <div class="space-y-4">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">First Name</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $profile->customer_details->first_name ?? '' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $profile->customer_details->middle_name ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Last Name</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $profile->customer_details->last_name ?? '' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Suffix Name</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $profile->customer_details->sufix_name ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $profile->customer_details->contact_number ?? '' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Birth Date</label>
                    <p class="mt-1 text-sm text-gray-900">
                        {{-- {{ $profile->customer_details->birth_date === null ? \Carbon\Carbon::parse($profile->customer_details->birth_date)->format('F j, Y') : '' }}</p> --}}
                        {{ $profile->customer_details->birth_date ?? '' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Gender</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $profile->customer_details->gender ?? '' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Marital Status</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $profile->customer_details->marital_status ?? '' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Province</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $profile->customer_details->province->name ?? '' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">City</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $profile->customer_details->city->name ?? '' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Barangay</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $profile->customer_details->barangay->name ?? '' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Address 1</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $profile->customer_details->address1 ?? '' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Address 2</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $profile->customer_details->address2 ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </x-container>

</div>
