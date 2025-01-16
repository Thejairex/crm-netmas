<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <a href="{{ route('backoffice.users.create') }}"
                            class="inline-block px-6 py-2 text-base font-semibold leading-6 text-white transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-700">
                            New User
                        </a>
                    </div>
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Username</th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Lastname</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Estado de la cuenta</th>
                                <th class="px-4 py-2">Genero</th>
                                <th class="px-4 py-2">Fecha de Nacimiento</th>
                                <th class="px-4 py-2">Telefono</th>
                                <th class="px-4 py-2">Documento</th>
                                <th class="px-4 py-2">Role</th>
                                <th class="px-4 py-2">Parent User</th>
                                <th class="px-4 py-2">Rank</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td class="border px-4 py-2">{{ $user->id }}</td>
                                <td class="border px-4 py-2">{{ $user->username }}</td>
                                <td class="border px-4 py-2">{{ $user->name ? $user->name : 'N/A' }}</td>
                                <td class="border px-4 py-2">{{ $user->lastname ? $user->lastname : 'N/A' }}</td>
                                <td class="border px-4 py-2">{{ $user->email }}</td>
                                <td class="border px-4 py-2">{{ $user->status }}</td>
                                <td class="border px-4 py-2">{{ $user->gender ? $user->gender : 'N/A' }}</td>
                                <td class="border px-4 py-2">{{ $user->birthdate ? $user->birthdate : 'N/A' }}</td>
                                <td class="border px-4 py-2">{{ $user->phone ? $user->phone : 'N/A' }}</td>
                                <td class="border px-4 py-2">{{ $user->document_type ? $user->document_type : 'N/A' }} ({{ $user->document_number ? $user->document_number : 'N/A' }})</td>
                                <td class="border px-4 py-2">{{ $user->role }}</td>
                                <td class="border px-4 py-2">{{ $user->parent ? $user->parent->name : 'Principal' }}</td>
                                <td class="border px-4 py-2">{{ $user->rank ? $user->rank->name : 'N/A' }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('backoffice.users.edit', $user) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                    <form action="{{ route('backoffice.users.destroy', $user) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
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
