<style>
    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }
</style>
<div class="flex">
    <!-- Sidebar -->
    <div class="w-64 bg-gray-800 text-white min-h-screen">
        <div class="p-4">
            {{-- <h2 class="text-xl font-semibold">Menu</h2> --}}
            <ul class="mt-4 space-y-2">
                <li><a href="#dashboard" class="block p-2 hover:bg-gray-600 rounded">Dashboard</a></li>
                <li><a href="#profile" class="block p-2 hover:bg-gray-600 rounded">Profile</a></li>
                <li><a href="#application-status" class="block p-2 hover:bg-gray-600 rounded">Application Status</a></li>
                <li><a href="#payment-histories" class="block p-2 hover:bg-gray-600 rounded">Payment Histories</a></li>
                <li><a href="#change-password" class="block p-2 hover:bg-gray-600 rounded">Change Password</a></li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 min-h-screen bg-gray-100 p-6">
        <!-- Dashboard Section -->
        <div id="dashboard" class="hidden">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800">Dashboard</h2>
                <p class="mt-4 text-gray-600">Welcome to the Dashboard. Here you can see an overview of your application
                    status and other relevant information.</p>
            </div>
        </div>

        <!-- Profile Section -->
        <div id="profile">
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
        <div id="application-status" class="hidden">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800">Application Status</h2>
                <p class="mt-4 text-gray-600">Here you can check the status of your application and view any updates.
                </p>
            </div>
        </div>

        <!-- Payment Histories Section -->
        <div id="payment-histories" class="hidden">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800">Payment Histories</h2>
                <p class="mt-4 text-gray-600">Here you can check the status of your payment histories and view any
                    updates.
                </p>
            </div>
        </div>

        <!-- Change Password Section -->
        <div id="change-password" class="hidden">
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

<!-- Optional JavaScript to toggle visibility -->
<script>
    document.querySelectorAll('ul li a').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            document.querySelectorAll('.main-content > div').forEach(section => {
                section.classList.add('hidden');
            });
            document.querySelector(this.getAttribute('href')).classList.remove('hidden');
        });
    });
</script>
