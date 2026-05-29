<x-guest-layout>
    <div class="min-h-screen flex bg-gray-50">        
        <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-purple-700 to-indigo-600 text-white flex-col justify-center items-center p-12 relative overflow-hidden">
            
            <div class="absolute top-10 left-10">
                <div class="flex items-center gap-3">                    
                    <span class="text-3xl font-bold">EasyStep</span>
                </div>
            </div>

            <div class="max-w-md text-center mt-10">
                <h1 class="text-5xl font-bold mb-6 leading-tight">Join EasyStep</h1>
                <p class="text-purple-100 text-lg">
                    Buat akun baru dan mulai perjalanan parenting yang lebih baik bersama kami.
                </p>                            
            </div>
        </div>        
        <div class="flex-1 flex items-center justify-center p-6 lg:p-12">
            <div class="w-full max-w-md">                
                <div class="lg:hidden flex justify-center mb-10">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-purple-600 rounded-2xl flex items-center justify-center text-white text-4xl font-bold">
                            E
                        </div>
                        <span class="text-3xl font-bold text-purple-600">EasyStep</span>
                    </div>
                </div>
                <h2 class="text-3xl font-semibold text-gray-800 text-center lg:text-left mb-8">
                    Buat Akun Baru
                </h2>                
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <form method="POST" action="{{ route('register') }}">
                    @csrf                    
                    <div class="mb-6">
                        <x-input-label for="name" :value="__('Full Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>                    
                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Email Address')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>                    
                    <div class="mb-6">
                        <x-input-label for="password" :value="__('Password')" />
                        <div class="relative">
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                            <button type="button" onclick="togglePassword(this)" 
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                👁
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>                    
                    <div class="mb-6">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <div class="relative">
                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <x-primary-button class="w-full py-4 text-lg font-semibold">
                        Register
                    </x-primary-button>
                </form>
                <div class="text-center mt-8 text-sm text-gray-600">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-purple-600 hover:text-purple-700 font-medium">Login</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(btn) {
            const input = document.getElementById('password');
            if (input.type === "password") {
                input.type = "text";
                btn.textContent = "🙈";
            } else {
                input.type = "password";
                btn.textContent = "👁";
            }
        }
    </script>
</x-guest-layout>