<!-- resources/views/livewire/email-verify.blade.php -->
<div class="min-h-screen flex justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-md w-full space-y-8">
      <div class="bg-white p-6 rounded-lg shadow-md">
          @if (session('message'))
              <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                  <span class="block sm:inline">{{ session('message') }}</span>
              </div>
          @endif

          <div class="mt-4 text-center">
              <p class="text-gray-600">{{ __('Before proceeding, please check your email for a verification link.') }}</p>
              <p class="text-gray-600">{{ __('If you did not receive the email') }},</p>
              <button wire:click="resendVerification" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                  {{ __('click here to request another') }}
              </button>
          </div>
      </div>
  </div>
</div>
