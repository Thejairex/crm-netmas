<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Educational Resource') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('failure'))
                        <div class="mb-4 text-red-600">
                            {{ session('failure') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-4 text-red-600">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('educational-resources.store') }}" enctype="multipart/form-data">
                        @csrf
                        <p class="text-sm text-gray-600">{{ __('The fields marked with * is required') }}</p>

                        <div>
                            <x-input-label for="title" :value="__('Title (*)')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description (*)')" />
                            <x-input-textarea id="description" class="block mt-1 w-full" name="description" required>{{ old('description') }}</x-textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="type" :value="__('Type (*)')" />
                            <select id="type" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="type" required>
                                <option value="" disabled selected>{{ __('Select type') }}</option>
                                <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>{{ __('Video') }}</option>
                                <option value="article" {{ old('type') == 'article' ? 'selected' : '' }}>{{ __('Article') }}</option>
                                <option value="document" {{ old('type') == 'document' ? 'selected' : '' }}>{{ __('Document') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="file" :value="__('File (*)')" />
                            <x-input-file id="file" class="block mt-1 w-full" type="file" name="file" accept="pdf,doc,docx,ppt,pptx,jpg,jpeg,png,gif,svg" />
                            <x-input-error :messages="$errors->get('file')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="video_url" :value="__('Video URL')" />
                            <x-text-input id="video_url" class="block mt-1 w-full" type="text" name="video_url" :value="old('video_url')" />
                            <x-input-error :messages="$errors->get('video_url')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Create') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
