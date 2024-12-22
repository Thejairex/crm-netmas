<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Educational Resources') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (Auth::user()->isAdmin())
                        <div class="flex justify-end mb-4">
                            <a href="{{ route('educational-resources.create') }}" class="btn btn-success">
                                Create New Resource
                            </a>
                        </div>
                    @endif

                    @foreach ($resources as $resource)
                        @switch($resource->type)
                            @case('video')
                                <div class="bg-yellow-100 p-4 rounded-lg mt-4">
                                    <h3 class="text-lg text-center font-semibold">{{ $resource->title }}</h3>
                                    <p class="text-center">{{ $resource->description }}</p>
                                    <div class="flex justify-center">
                                        <a href="{{ $resource->video_url }}" class="btn btn-primary" target="_blank">Ver
                                            video</a>
                                    </div>
                                </div>
                            @break

                            @case('article')
                                <div class="bg-green-100 p-4 rounded-lg mt-4">
                                    <h3 class="text-lg text-center font-semibold">{{ $resource->title }}</h3>
                                    <p class="text-center">{{ $resource->description }}</p>
                                    <div class="flex justify-center">
                                        <a href="{{ url('storage/' . $resource->file_path) }}" class="btn btn-primary"
                                            target="_blank">Ver archivo</a>
                                    </div>
                                </div>
                            @break

                            @case('document')
                                <div class="bg-blue-100 p-4 rounded-lg mt-4">
                                    <h3 class="text-lg text-center font-semibold">{{ $resource->title }}</h3>
                                    <p class="text-center">{{ $resource->description }}</p>
                                    <div class="flex justify-center mt-4">
                                        <a href="{{ url('storage/' . $resource->file_path) }}" class="btn btn-primary"
                                            target="_blank">Ver archivo</a>
                                        <a href="{{ url('storage/' . $resource->file_path) }}" class="btn btn-primary ms-2"
                                            download="{{ $resource->title }}.{{ $resource->file_path_extension }}">Descargar
                                            archivo</a>

                                    </div>
                                </div>
                            @break

                            @default
                                <div class="bg-gray-100 p-4 rounded-lg mt-4">
                                    <h3 class="text-lg text-center font-semibold">{{ $resource->title }}</h3>
                                    <p class="text-center">{{ $resource->description }}</p>
                                    <div class="flex justify-center">
                                        <a href="{{ url('storage/' . $resource->file_path) }}" class="btn btn-primary"
                                            target="_blank">Ver archivo</a>
                                        @if (Auth::user()->isAdmin())
                                            <a href="{{ route('educational-resources.edit', $resource->id) }}"
                                                class="btn btn-primary ms-2">Editar</a>

                                            <form action="{{ route('educational-resources.destroy', $resource->id) }}"
                                                method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger ms-2">Eliminar</button>
                                            </form>

                                        @endif
                                    </div>
                                </div>
                        @endswitch
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
