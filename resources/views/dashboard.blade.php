<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
                <div class="border-t border-gray-200"></div>
                <div class="p-6 text-gray-900">
                    {{ Auth::user()->name }} {{ Auth::user()->lastname }}
                    @if (Auth::user()->parent_id)
                        <div>
                            Parent: {{ Auth::user()->parent->name }}
                        </div>
                    @endif
                </div>
                <a href="/profile/kyc">Vincular cuenta</a>
                @if (Auth::user()->isAdmin())
                    <a href="/kyc/administration">Gestión de cuentas</a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>