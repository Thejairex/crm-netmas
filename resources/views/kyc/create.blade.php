<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Solicitud de verificación de identidad (KYC)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('kyc.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Nombre')" />

                            <x-text-input id="name" class="block mt-1 w-full" type="text"
                                name="name" :value="old('name')" required />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="lastname" :value="__('Apellido')" />

                            <x-text-input id="lastname" class="block mt-1 w-full" type="text"
                                name="lastname" :value="old('lastname')" required />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="phone" :value="__('Número de teléfono')" />

                            <x-text-input id="phone" class="block mt-1 w-full" type="text"
                                name="phone" :value="old('phone')" required />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="gender" :value="__('Género')" />
                            <select name="gender" id="gender" required>
                                <option value="male">Masculino</option>
                                <option value="female">Femenino</option>
                                <option value="other">Otro</option>
                            </select>
                        </div>
                        <div>
                            <x-input-label for="document_type" :value="__('Tipo de documento')" />
                            <select name="document_type" id="document_type" required>
                                <option value="passport">Pasaporte</option>
                                <option value="id_card">Cédula de Identidad</option>
                                <option value="driver_license">Licencia de Conducir</option>
                            </select>

                        </div>

                        <div class="mt-4">
                            <x-input-label for="document_number" :value="__('Número de identificación')" />

                            <x-text-input id="document_number" class="block mt-1 w-full" type="text"
                                name="document_number" :value="old('document_number')" required />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="document_image" :value="__('Imagen del documento')" />

                            <x-input-file id="document_image" name="document_image" required />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="birth_date" :value="__('Fecha de nacimiento')" />

                            <x-input-date id="birth_date"
                                name="birth_date" :value="old('birth_date')" required />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Enviar solicitud') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
