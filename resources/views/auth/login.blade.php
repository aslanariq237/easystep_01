<x-guest-layout>
    <div class="flex bg-gray-50">

        <!-- LEFT SIDE - Welcome Back (Hanya muncul di layar besar / Laptop) -->
        <div class="hidden md:flex lg:w-1/2 bg-gradient-to-br from-purple-700 to-indigo-600 text-white flex-col justify-center items-center p-12">
            
            <div class="absolute top-12 left-12">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white rounded-2xl flex items-center justify-center text-purple-600 text-3xl font-bold">
                        Welcome Back
                    </div>                    
                </div>
            </div>

            <div class="max-w-md text-center">
                <h1 class="text-5xl font-bold mb-6 leading-tight">Welcome Back!</h1>
                <p class="text-purple-100 text-lg">
                    Masuk ke akun Anda dan lanjutkan perjalanan parenting yang bermakna.
                </p>

                <div class="mt-16">                    
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE - Login Form -->
        <div class="flex-1 flex items-center justify-center p-6 md:p-12">

            <div class="w-full max-w-md">

                <!-- Logo untuk Mobile -->
                <div class="lg:hidden flex justify-center mb-10">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-purple-600 rounded-2xl flex items-center justify-center text-white text-4xl font-bold">
                            E
                        </div>
                        <span class="text-3xl font-bold text-purple-600">EasyStep</span>
                    </div>
                </div>

                <h2 class="text-3xl font-semibold text-gray-800 text-center lg:text-left mb-8">
                    Welcome Back!
                </h2>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email or Username -->
                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Email or Username')" />
                        <x-text-input id="email" 
                                      class="block mt-1 w-full" 
                                      type="text" 
                                      name="email" 
                                      :value="old('email')" 
                                      required 
                                      autofocus 
                                      placeholder="Enter your email or username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <x-input-label for="password" :value="__('Password')" />
                        <div class="relative">
                            <x-text-input id="password" 
                                          class="block mt-1 w-full" 
                                          type="password" 
                                          name="password" 
                                          required 
                                          placeholder="Enter your password" />
                            <button type="button" 
                                    onclick="togglePassword(this)"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 text-xl">
                                👁
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between mb-6">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" name="remember" 
                                   class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                            <span class="ms-2 text-sm text-gray-600">Remember me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" 
                               class="text-sm text-purple-600 hover:text-purple-700">
                                Forgot Password?
                            </a>
                        @endif
                    </div>

                    <x-primary-button class="w-full py-4 text-lg font-semibold">
                        Login
                    </x-primary-button>
                </form>

                {{-- <div class="text-center mt-8 text-sm text-gray-600">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-purple-600 font-medium hover:underline">Sign Up</a>
                </div> --}}

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
{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
