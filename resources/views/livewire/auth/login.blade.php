<div>
    <div class="min-h-screen flex justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-6">Login</h2>
                @if (session()->has('error'))
                    <div class="bg-red-500 text-white p-2 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif
                <form wire:submit.prevent="login">
                    @csrf
                    <div>
                        <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                        <input placeholder="Email Address" type="email" wire:model="email" id="email"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4 mt-2">
                        <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                        <input placeholder="Passwword" type="password" wire:model="password" id="password"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">
                            <input type="checkbox" wire:model="remember" class="mr-2 leading-tight">
                            <span class="text-sm">Remember Me</span>
                        </label>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class=" w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            <span wire:loading.remove wire:target="login">Login</span>
                            <span wire:loading wire:target="login">Loading...</span>
                        </button>
                    </div>
                </form>
                <div class="text-center mt-4">
                    <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700">
                        No Account? Register now
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
