<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('backoffice.users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Nombre')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                value="{{ $user->name }}" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="lastname" :value="__('Apellido')" />
                            <x-text-input id="lastname" class="block mt-1 w-full" type="text" name="lastname"
                                value="{{ $user->lastname }}" required />
                            <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Correo Electrónico')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                value="{{ $user->email }}" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="role" :value="__('Rol')" />
                            <select name="role" id="role" class="block mt-1 w-full" required>
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Usuario</option>
                                <option value="supplier" {{ $user->role == 'supplier' ? 'selected' : '' }}>Distribuidor
                                </option>

                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrador
                                </option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Actualizar') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
