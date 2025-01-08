<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar recurso educativo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('educational-resources.update', $educationalResource->id) }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-label for="title" :value="__('Title')" />

                            <x-input id="title" class="block mt-1 w-full"
                                    type="text"
                                    name="title"
                                    value="{{ $educationalResource->title }}"
                                    required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="description" :value="__('Description')" />

                            <x-textarea id="description" class="block mt-1 w-full"
                                        name="description"
                                        required>{{ $educationalResource->description }}</x-textarea>
                        </div>

                        <div class="mt-4">
                            <x-label for="type" :value="__('Type')" />

                            <select id="type" class="block mt-1 w-full" name="type" required>
                                <option value="video" {{ $educationalResource->type === 'video' ? 'selected' : '' }}>Video</option>
                                <option value="document" {{ $educationalResource->type === 'document' ? 'selected' : '' }}>Documento</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-label for="file" :value="__('File')" />

                            <x-input id="file" class="block mt-1 w-full"
                                    type="file"
                                    name="file"
                                    accept=".pdf,.doc,.docx,.ppt,.pptx,.jpg,.jpeg,.png,.gif,.svg"
                                    />
                        </div>

                        <div class="mt-4">
                            <x-label for="video_url" :value="__('Video URL')" />

                            <x-input id="video_url" class="block mt-1 w-full"
                                    type="text"
                                    name="video_url"
                                    value="{{ $educationalResource->video_url }}" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
