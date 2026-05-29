<x-guest-layout>
    <div class="min-h-screen flex bg-gray-50">
        <div class="flex-1 flex items-center justify-center p-6">
            <div class="w-full max-w-md">
                <h2 class="text-3xl font-semibold text-gray-800 text-center mb-8">Lupa Password?</h2>

                @if(session('error'))
                    <div class="bg-red-100 text-red-700 p-4 rounded-2xl mb-6 text-center">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-4 rounded-2xl mb-6 text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Masukkan Email Anda')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <button type="submit" 
                            class="w-full bg-purple-600 hover:bg-purple-700 text-white py-4 rounded-2xl font-semibold">
                        Cek Email & Reset Password
                    </button>
                </form>

                <div class="text-center mt-6">
                    <a href="{{ route('login') }}" class="text-purple-600 hover:underline">← Kembali ke Login</a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>