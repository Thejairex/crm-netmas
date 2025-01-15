<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle de Solicitud de KYC') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Información del Usuario') }}</h3>
                    <p><strong>{{ __('Username:') }}</strong> {{ $user->username }}</p>
                    <p><strong>{{ __('Nombre:') }}</strong> {{ $kycData->name }}</p>
                    <p><strong>{{ __('Apellido:') }}</strong> {{ $kycData->lastname }}</p>
                    <p><strong>{{ __('Género:') }}</strong> {{ $kycData->gender }}</p>
                    <p><strong>{{ __('Teléfono:') }}</strong> {{ $kycData->phone }}</p>
                    <p><strong>{{ __('Email:') }}</strong> {{ $user->email }}</p>

                    <h3 class="text-lg font-medium text-gray-900 mt-4">{{ __('Información de KYC') }}</h3>
                    <p><strong>{{ __('Tipo de Documento:') }}</strong> {{ $kycData->document_type }}</p>
                    <p><strong>{{ __('Número de Documento:') }}</strong> {{ $kycData->document_number }}</p>
                    <p><strong>{{ __('Fecha de Nacimiento:') }}</strong> {{ $kycData->birth_date }}</p>
                    <p><strong>{{ __('Estado:') }}</strong>
                        @if ($kycData->status === 'pending')
                            <span class="text-yellow-500">{{ __('Pendiente') }}</span>
                        @elseif ($kycData->status === 'verified')
                            <span class="text-green-500">{{ __('Verificado') }}</span>
                        @elseif ($kycData->status === 'rejected')
                            <span class="text-red-500">{{ __('Rechazado') }}</span>
                        @endif
                    </p>
                    @if ($kycData->status === 'verified')
                        <p><strong>{{ __('Verificado por:') }}</strong> {{ $kycData->verified_by }}</p>
                        <p><strong>{{ __('Fecha de Verificación:') }}</strong> {{ $kycData->verified_at }}</p>
                    @endif
                    @if ($kycData->rejection_reason)
                        <p><strong>{{ __('Razón de Rechazo:') }}</strong> {{ $kycData->rejection_reason }}</p>
                    @endif

                    <h3 class="text-lg font-medium text-gray-900 mt-4">{{ __('Imagen del Documento') }}</h3>
                    <img src="{{ asset('storage/' . $kycData->document_image) }}" alt="Document Image" class="mt-2 w-50 max-w-md" style="max-height: 200px;">
                </div>

                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($kycData->status === 'pending')
                        <form action="{{ route('kyc.update', $kycData->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="mt-4">
                                <label for="status" class="block text-sm font-medium text-gray-700">Accion</label>
                                <select name="status" id="status" class="mt-1 block w-full pl-10 text-base text-gray-900 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="approved">Aprobar</option>
                                    <option value="rejected">Rechazar</option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <label for="rejection_reason" class="block text-sm font-medium text-gray-700">Razón de Rechazo</label>
                                <textarea name="rejection_reason" id="rejection_reason" class="mt-1 block w-full px-3 py-2 text-base text-gray-900 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" rows="3"></textarea>
                            </div>
                            <div class="mt-4">
                                <x-button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    {{ __('Enviar') }}
                                </x-button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

