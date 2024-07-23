<style>
    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .active-tab {
        background-color: #2b6cb0; /* Your active tab background color */
    }
</style>
<div x-data="{ activeTab: 'profile' }" class="flex">
    <!-- Sidebar -->
    <div class="w-64 bg-gray-800 text-white min-h-screen">
        <div class="p-4">
            <ul class="mt-4 space-y-2">
                <li><a @click="activeTab = 'dashboard'" :class="{ 'active-tab': activeTab === 'dashboard' }" href="#" class="block p-2 hover:bg-gray-600 rounded">Dashboard</a></li>
                <li><a @click="activeTab = 'profile'" :class="{ 'active-tab': activeTab === 'profile' }" href="#" class="block p-2 hover:bg-gray-600 rounded">Profile</a></li>
                <li><a @click="activeTab = 'application-status'" :class="{ 'active-tab': activeTab === 'application-status' }" href="#" class="block p-2 hover:bg-gray-600 rounded">Application Status</a></li>
                <li><a @click="activeTab = 'payment-histories'" :class="{ 'active-tab': activeTab === 'payment-histories' }" href="#" class="block p-2 hover:bg-gray-600 rounded">Payment Histories</a></li>
                <li><a @click="activeTab = 'change-password'" :class="{ 'active-tab': activeTab === 'change-password' }" href="#" class="block p-2 hover:bg-gray-600 rounded">Change Password</a></li>
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
            <div class="bg-white shadow-md rounded-lg p-6 relative">
                <!-- Loan Details -->
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Loan Details</h2>
                    <!-- Replace with actual loan details and data -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Loan Amount</label>
                            <p class="mt-1 text-sm text-gray-900">$10,000</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Interest Rate</label>
                            <p class="mt-1 text-sm text-gray-900">5%</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Term</label>
                            <p class="mt-1 text-sm text-gray-900">24 months</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Monthly Payment</label>
                            <p class="mt-1 text-sm text-gray-900">$450</p>
                        </div>
                    </div>
                </div>
        
                <!-- Loan Progress Tracking -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Loan Progress</h2>
        
                    <!-- Status Steps with Descriptions (Vertical Layout) -->
                    <div class="flex flex-col space-y-4">
                        <!-- Step: Review -->
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-500 text-white">
                                <span class="text-lg font-bold">1</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Review</h3>
                                <p class="text-sm text-gray-600">Your application is being reviewed by our team.</p>
                            </div>
                        </div>
        
                        <!-- Step: In Progress -->
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-gray-300 text-gray-400 opacity-50">
                                <span class="text-lg font-bold">2</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-400">In Progress</h3>
                                <p class="text-sm text-gray-400">Your application is currently in progress.</p>
                            </div>
                        </div>
        
                        <!-- Step: Approve -->
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-gray-300 text-gray-400 opacity-50">
                                <span class="text-lg font-bold">3</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-400">Approve</h3>
                                <p class="text-sm text-gray-400">Your application has been approved.</p>
                            </div>
                        </div>
        
                        <!-- Step: Release -->
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-gray-300 text-gray-400 opacity-50">
                                <span class="text-lg font-bold">4</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-400">Release</h3>
                                <p class="text-sm text-gray-400">Funds have been released to your account.</p>
                            </div>
                        </div>
                    </div>
                </div>
        
               
            </div>
        </div>

        <!-- Payment Histories Section -->
        <div id="payment-histories" x-show="activeTab === 'payment-histories'">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Payment Histories</h2>
        
                <!-- Example payment histories (replace with dynamic data) -->
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-gray-100 rounded-lg overflow-hidden">
                        <thead class="bg-gray-200 text-gray-700">
                            <tr>
                                <th class="py-2 px-4 text-left">Payment Date</th>
                                <th class="py-2 px-4 text-left">Amount Paid</th>
                                <th class="py-2 px-4 text-left">Payment Method</th>
                                <th class="py-2 px-4 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            <!-- Replace this with a loop over payment history data -->
                            <tr class="bg-white border-b">
                                <td class="py-2 px-4">July 15, 2024</td>
                                <td class="py-2 px-4">$500.00</td>
                                <td class="py-2 px-4">Credit Card</td>
                                <td class="py-2 px-4">
                                    <span class="px-2 py-1 text-xs text-white bg-green-500 rounded-full">Paid</span>
                                </td>
                            </tr>
                            <tr class="bg-gray-50 border-b">
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
                            </tr>
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
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Change
                        Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
