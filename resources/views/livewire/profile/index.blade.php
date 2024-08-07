<style>
    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .active-tab {
        background-color: #2b6cb0;
        /* Your active tab background color */
    }
</style>
<div x-data="{ activeTab: 'profile' }" class="flex">
    <!-- Sidebar -->
    <div class="w-64 bg-gray-800 text-white min-h-screen">
        <div class="p-4">
            <ul class="mt-4 space-y-2">
                <li><a @click="activeTab = 'dashboard'" :class="{ 'active-tab': activeTab === 'dashboard' }" href="#"
                        class="block p-2 hover:bg-gray-600 rounded">Dashboard</a></li>
                <li><a @click="activeTab = 'profile'" :class="{ 'active-tab': activeTab === 'profile' }" href="#"
                        class="block p-2 hover:bg-gray-600 rounded">Profile</a></li>
                <li><a @click="activeTab = 'application-status'"
                        :class="{ 'active-tab': activeTab === 'application-status' }" href="#"
                        class="block p-2 hover:bg-gray-600 rounded">Application Status</a></li>
                <li><a @click="activeTab = 'payment-histories'"
                        :class="{ 'active-tab': activeTab === 'payment-histories' }" href="#"
                        class="block p-2 hover:bg-gray-600 rounded">Monthly Dues</a></li>
                <li><a @click="activeTab = 'change-password'" :class="{ 'active-tab': activeTab === 'change-password' }"
                        href="#" class="block p-2 hover:bg-gray-600 rounded">Change Password</a></li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 min-h-screen bg-gray-100 p-6">
        <!-- Dashboard Section -->
        <div id="dashboard" x-show="activeTab === 'dashboard'">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800">Dashboard</h2>
                <p class="mt-4 text-gray-600">Welcome to the Dashboard. Here you can see an overview of your application
                    status and other relevant information.</p>
            </div>
        </div>

        <!-- Profile Section -->
        <div id="profile" x-show="activeTab === 'profile'">
            <!-- Content for Profile -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800">Profile Information</h2>
                <div class="grid grid-cols-4 gap-8 md:grid-cols-4">
                    <!-- Profile Information Content -->
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
                        <p class="mt-1 text-sm text-gray-900">{{ $profile->customer_details->birth_date ?? '' }}</p>
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
                        <p class="mt-1 text-sm text-gray-900">{{ $profile->customer_details->barangay->name ?? '' }}
                        </p>
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
        </div>

        <!-- Application Status Section -->
        <div id="application-status" x-show="activeTab === 'application-status'">
            @livewire('profile.application-status')
        </div>

        <!-- Payment Histories Section -->
        <div id="payment-histories" x-show="activeTab === 'payment-histories'">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Monthly Dues</h2>

                <!-- Example payment histories (replace with dynamic data) -->
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-gray-100 rounded-lg overflow-hidden">
                        <thead class="bg-gray-200 text-gray-700">
                            <tr>
                                <th class="py-2 px-4 text-left">Due Date</th>
                                <th class="py-2 px-4 text-left">Monthly Payment</th>
                                <th class="py-2 px-4 text-left">Amount Paid</th>
                                <th class="py-2 px-4 text-left">Payment Method</th>
                                <th class="py-2 px-4 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse ($monthlyDues as $item)
                                <tr class="bg-white border-b">
                                    <td class="py-2 px-4">
                                        {{ \Carbon\Carbon::parse($item->due_date)->format('F d, Y') }}</td>
                                    <td class="py-2 px-4">Php {{ $item->monthly_payment }}</td>
                                    <td class="py-2 px-4">{{ $item->payment_method ?? '' }}</td>
                                    <td class="py-2 px-4">{{ $item->amount_paid ?? '' }}</td>
                                    <td class="py-2 px-4">
                                        @if ($item->status == 'paid')
                                            <span
                                                class="px-2 py-1 text-xs text-white bg-green-500 rounded-full">Paid</span>
                                        @else
                                            <span
                                                class="px-2 py-1 text-xs text-white bg-yellow-500 rounded-full">UnPaid</span>
                                        @endif

                                    </td>
                                </tr>
                            @empty
                            @endforelse
                            <!-- Replace this with a loop over payment history data -->

                            {{-- <tr class="bg-gray-50 border-b">
                                <td class="py-2 px-4">June 30, 2024</td>
                                <td class="py-2 px-4">$300.00</td>
                                <td class="py-2 px-4">Bank Transfer</td>
                                <td class="py-2 px-4">
                                    <span class="px-2 py-1 text-xs text-white bg-green-500 rounded-full">Paid</span>
                                </td>
                            </tr>
                            <tr class="bg-white border-b">
                                <td class="py-2 px-4">June 15, 2024</td>
                                <td class="py-2 px-4">$200.00</td>
                                <td class="py-2 px-4">PayPal</td>
                                <td class="py-2 px-4">
                                    <span class="px-2 py-1 text-xs text-white bg-green-500 rounded-full">Paid</span>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Change Password Section -->
        <div id="change-password" x-show="activeTab === 'change-password'">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800">Change Password</h2>
                <form action="#" method="POST" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Current Password</label>
                        <input type="password" name="current_password"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">New Password</label>
                        <input type="password" name="new_password"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                        <input type="password" name="confirm_new_password"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Change
                        Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
