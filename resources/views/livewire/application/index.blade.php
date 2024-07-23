<div>
    <div class="min-h-screen flex justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl w-full space-y-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4">Motorcycle Loan Application</h2>

                @if (session()->has('success'))
                    <div class="bg-green-200 text-green-800 p-4 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="bg-red-200 text-red-800 p-4 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <form wire:submit.prevent="submit">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">Name</label>
                        <input readonly type="text" id="name" wire:model="name"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        @error('name')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">Email</label>
                        <input readonly type="email" id="email" wire:model="email"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        @error('email')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700">Phone Number</label>
                        <input readonly type="text" id="phone" wire:model="phone"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        @error('phone')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="source_of_income" class="block text-gray-700">Source of Income</label>
                        <select wire:model.live="source_of_income" id="source_of_income"
                            class="mt-1 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Select Source of Income</option>
                            <option value="business">Business</option>
                            <option value="salary">Salary</option>
                            <option value="pension">Pension</option>
                        </select>
                        @error('source_of_income')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    @if ($source_of_income === 'salary')
                        <div class="mb-4">
                            <label for="company_name" class="block text-gray-700">What is your Company Name?</label>
                            <input type="text" id="company_name" wire:model="company_name"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                            @error('company_name')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="work_position" class="block text-gray-700">What is your work?</label>
                            <input type="text" id="work_position" wire:model="work_position"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                            @error('work_position')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="years_in_work" class="block text-gray-700">Years of experience in the
                                company</label>
                            <input type="text" id="years_in_work" wire:model="years_in_work"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                            @error('years_in_work')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="monthly_income" class="block text-gray-700">What is your monthly salary?</label>
                            <input type="text" id="monthly_income" wire:model="monthly_income"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                            @error('monthly_income')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    @elseif ($source_of_income === 'business')
                        <div class="mb-4">
                            <label for="name_of_business" class="block text-gray-700">Name of your Business</label>
                            <input type="text" id="name_of_business" wire:model="name_of_business"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                            @error('name_of_business')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="monthly_income" class="block text-gray-700">Estimated Monthly Income</label>
                            <input type="text" id="monthly_income" wire:model="monthly_income"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                            @error('monthly_income')
                                <span class="text-red-600 text-sm">Monthly Income is required</span>
                            @enderror
                        </div>
                    @elseif($source_of_income === 'pension')
                        <div class="mb-4">
                            <label for="monthly_income" class="block text-gray-700">Monthly Pension</label>
                            <input type="text" id="monthly_income" wire:model="monthly_income"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                            @error('monthly_income')
                                <span class="text-red-600 text-sm">Monthly Pension is required</span>
                            @enderror
                        </div>
                    @endif

                    <hr>

                    <div class="mb-4 mt-4">
                        <label for="months_to_pay" class="block text-gray-700">How Many Months to Pay?</label>
                        <select wire:model.live="months_to_pay" id="months_to_pay"
                            class="mt-1 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Select How Many Months</option>
                            <option value="6">6 Months</option>
                            <option value="12">12 Months</option>
                            <option value="24">24 Months</option>
                            <option value="36">36 Months</option>
                        </select>
                        @error('months_to_pay')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="downpayment" class="block text-gray-700">Downpayment</label>
                        <input type="text" id="downpayment" wire:model.live="downpayment"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        @error('downpayment')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="product" class="block text-gray-700">Motorcycle</label>
                        <select wire:model.live="product" id="product"
                            class="mt-1 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Select Motorcycle</option>
                            @foreach ($products as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('product')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="loan_amount" class="block text-gray-700">Loan Amount</label>
                        <input readonly type="number" id="loan_amount" wire:model="loan_amount"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        @error('loan_amount')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="monthly_payment_amount" class="block text-gray-700">Monthly Amortization</label>
                        <input readonly type="number" id="monthly_payment_amount"
                            wire:model="monthly_payment_amount"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        @error('monthly_payment_amount')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="terms" class="inline-flex items-center">
                            <input type="checkbox" id="terms" wire:model="terms"
                                class="form-checkbox text-blue-600">
                            <span class="ml-2 text-gray-700">I agree to the terms and conditions</span>
                        </label>
                        @error('terms')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        <span wire:loading.remove wire:target="submit">Submit Application</span>
                        <span wire:loading wire:target="submit">Loading...</span>
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
