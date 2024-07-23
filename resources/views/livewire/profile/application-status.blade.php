<div>
    <div class="bg-white shadow-md rounded-lg p-6 relative">
        <!-- Loan Details -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Loan Details</h2>
            <!-- Replace with actual loan details and data -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Loan Amount</label>
                    <p class="mt-1 text-sm text-gray-900">Php {{ $loan_amount ?? 0 }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Interest Rate</label>
                    <p class="mt-1 text-sm text-gray-900"{{ $interest_rate }} %</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Term</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $term }} months</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Monthly Payment</label>
                    <p class="mt-1 text-sm text-gray-900">$ {{ $monthly_payment }}</p>
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
                    <div class="w-12 h-12 flex items-center justify-center rounded-full {{ $forReview ? ' bg-blue-500 text-white' : 'bg-gray-300 text-gray-400 opacity-50' }}">
                        <span class="text-lg font-bold">1</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-{{ $forReview ? '900' : '400' }}">For Review</h3>
                        <p class="text-sm text-gray-600">Your application is being reviewed by our team.</p>
                    </div>
                </div>

                <!-- Step: In Progress -->
                <div class="flex items-center space-x-4">
                    <div
                        class="w-12 h-12 flex items-center justify-center rounded-full {{ $inProgress ? ' bg-blue-500 text-white' : 'bg-gray-300 text-gray-400 opacity-50' }}">
                        <span class="text-lg font-bold">2</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-{{ $inProgress ? '900' : '400' }}">In Progress</h3>
                        <p class="text-sm text-gray-400">Your application is currently in progress.</p>
                    </div>
                </div>

                <!-- Step: Approve -->
                <div class="flex items-center space-x-4">
                    <div
                        class="w-12 h-12 flex items-center justify-center rounded-full {{ $approved ? ' bg-blue-500 text-white' : 'bg-gray-300 text-gray-400 opacity-50' }}">
                        <span class="text-lg font-bold">3</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-{{ $approved ? '900' : '400' }}">Approve</h3>
                        <p class="text-sm text-gray-400">Your application has been approved.</p>
                    </div>
                </div>

                <!-- Step: Release -->
                <div class="flex items-center space-x-4">
                    <div
                        class="w-12 h-12 flex items-center justify-center rounded-full {{ $released ? ' bg-blue-500 text-white' : 'bg-gray-300 text-gray-400 opacity-50' }}">
                        <span class="text-lg font-bold">4</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-{{ $released ? '900' : '400' }}">Release</h3>
                        <p class="text-sm text-gray-400">Get your MotorCycle</p>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
