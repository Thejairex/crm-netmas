<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('KYC Solicitudes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Nombre</th>
                                <th class="px-4 py-2">Apellido</th>
                                <th class="px-4 py-2">Genero</th>
                                <th class="px-4 py-2">Phone</th>
                                <th class="px-4 py-2">Documento</th>
                                <th class="px-4 py-2">Estado</th>
                                <th class="px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kycs as $kyc)
                                <tr>
                                    <td class="px-4 py-2">{{ $kyc->name }}</td>
                                    <td class="px-4 py-2">{{ $kyc->lastname }}</td>
                                    <td class="px-4 py-2">{{ $kyc->gender }}</td>
                                    <td class="px-4 py-2">{{ $kyc->phone }}</td>
                                    <td class="px-4 py-2">{{ $kyc->document_type }} {{ $kyc->document_number }}</td>
                                    <td class="px-4 py-2">{{ $kyc->status }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('kyc.show', $kyc->id) }}" class="text-blue-500 hover:text-blue-700">Ver</a>
                                        <form action="{{ route('kyc.destroy', $kyc->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
