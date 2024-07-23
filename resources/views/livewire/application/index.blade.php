<div>
    <div class="min-h-screen flex justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl w-full space-y-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4">Motorcycle Loan Application</h2>

                @if (session()->has('message'))
                    <div class="bg-green-200 text-green-800 p-4 rounded mb-4">
                        {{ session('message') }}
                    </div>
                @endif

                <form wire:submit.prevent="submit">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">Name</label>
                        <input type="text" id="name" wire:model="name"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        @error('name')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">Email</label>
                        <input type="email" id="email" wire:model="email"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        @error('email')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700">Phone Number</label>
                        <input type="text" id="phone" wire:model="phone"
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

                    <div class="mb-4">
                        <label for="work" class="block text-gray-700">What is your work?</label>
                        <input type="text" id="work" wire:model="work"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        @error('work')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="years_of_exp_in_company" class="block text-gray-700">Years experience in the
                            company</label>
                        <input type="text" id="years_of_exp_in_company" wire:model="years_of_exp_in_company"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        @error('years_of_exp_in_company')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="monthly_salary" class="block text-gray-700">What is your monthly salary?</label>
                        <input type="text" id="monthly_salary" wire:model="monthly_salary"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        @error('monthly_salary')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
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
                        <label for="down_payment" class="block text-gray-700">Down Payment</label>
                        <input type="text" id="down_payment" wire:model="down_payment"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        @error('down_payment')
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
                        <label for="monthly_amort" class="block text-gray-700">Monthly Amortization</label>
                        <input readonly type="number" id="monthly_amort" wire:model="monthly_amort"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        @error('monthly_amort')
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

                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Submit</button>
                </form>
            </div>

        </div>
    </div>
</div>
