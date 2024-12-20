<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('IMEI Validations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">IMEI</th>
                                <th class="px-4 py-2">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($validations as $validation)
                                <tr>
                                    <td class="px-4 py-2">{{ $validation->imei }}</td>
                                    <td class="px-4 py-2">
                                        @if ($validation->is_valid)
                                            <span class="inline-block bg-green-500 px-2 py-1 rounded-full text-white">Válido</span>
                                        @else
                                            <span class="inline-block bg-red-500 px-2 py-1 rounded-full text-white">No válido</span>
                                        @endif
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
