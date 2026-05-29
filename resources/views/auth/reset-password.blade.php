<x-guest-layout>
    <div class="min-h-screen flex bg-gray-50">
        <div class="flex-1 flex items-center justify-center p-6">
            <div class="w-full max-w-md">
                <h2 class="text-3xl font-semibold text-gray-800 text-center mb-8">Reset Password</h2>

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="mb-6">
                        <x-input-label for="password" :value="__('Password Baru')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                    </div>

                    <button type="submit" 
                            class="w-full bg-purple-600 hover:bg-purple-700 text-white py-4 rounded-2xl font-semibold">
                        Reset Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>