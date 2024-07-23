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
                        <label for="motorcycle_model" class="block text-gray-700">Motorcycle Model</label>
                        <input type="text" id="motorcycle_model" wire:model="motorcycle_model"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        @error('motorcycle_model')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="loan_amount" class="block text-gray-700">Loan Amount</label>
                        <input type="number" id="loan_amount" wire:model="loan_amount"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                        @error('loan_amount')
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
