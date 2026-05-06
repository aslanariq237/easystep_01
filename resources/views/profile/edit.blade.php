<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-4xl mx-auto px-4">

            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Edit Profil</h1>
                <a href="{{ route('profile.show') }}" 
                   class="text-gray-500 hover:text-gray-700 flex items-center gap-2">
                    ← Kembali ke Profil
                </a>
            </div>

            <div class="bg-white rounded-3xl shadow-sm p-8">

                <!-- Update Profile Information -->
                <div class="mb-12">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <hr class="my-10">

                <!-- Update Password -->
                <div class="mb-12">
                    @include('profile.partials.update-password-form')
                </div>

                <hr class="my-10">

                <!-- Delete Account -->
                <div>
                    @include('profile.partials.delete-user-form')
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
