<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <!-- form of verification -->
                <div class="max-w-xl">
                    @include('profile.partials.verify-customer-form')
                </div>
            </div>

            @can('CompletedKYC')
                <div>
                    <!-- Vincular cuenta -->
                    <div class="max-w-xl">
                        @include('profile.partials.link-account-form')
                    </div>
                </div>
            @else
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <p class="text-sm text-gray-600">
                            Para vincular su cuenta con otras cuentas, debe verificar su
                            identidad primero. Por favor, verifique su identidad y
                            vuelva a intentarlo.
                        </p>
                    </div>
                </div>
            @endcan


            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
