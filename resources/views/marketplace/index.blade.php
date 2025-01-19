<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Marketplace') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between">
                        <div class="w-1/4">
                            <form action="{{ route('marketplace.index') }}" method="GET">
                                <div class="mb-4">
                                    <label for="category" class="block text-sm font-medium text-gray-700">{{ __('Category') }}</label>
                                    <select id="category" name="category" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="">{{ __('All') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="min_price" class="block text-sm font-medium text-gray-700">{{ __('Min price') }}</label>
                                    <input type="number" id="min_price" name="min_price" value="{{ request('min_price') }}" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>

                                <div class="mb-4">
                                    <label for="max_price" class="block text-sm font-medium text-gray-700">{{ __('Max price') }}</label>
                                    <input type="number" id="max_price" name="max_price" value="{{ request('max_price') }}" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>

                                <div class="mb-4">
                                    <label for="order" class="block text-sm font-medium text-gray-700">{{ __('Order') }}</label>
                                    <select id="order" name="order" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="">{{ __('All') }}</option>
                                        <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>{{ __('ASC') }}</option>
                                        <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>{{ __('DESC') }}</option>
                                    </select>
                                </div>

                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                    {{ __('Filter') }}
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($products as $product)
                            <div class="bg-white rounded-lg shadow-md">
                                <a href="{{ route('marketplace.show', $product) }}">
                                    <img class="w-full h-56 object-cover" src="{{ $product->image }}" alt="{{ $product->name }}">
                                </a>
                                <div class="p-4">
                                    <a href="{{ route('marketplace.show', $product) }}" class="text-lg font-semibold text-gray-800 hover:text-gray-600">
                                        {{ $product->name }}
                                    </a>
                                    <p class="mt-2 text-sm text-gray-600">
                                        {{ $product->description }}
                                    </p>
                                    <p class="mt-2 text-sm font-semibold text-gray-800">
                                        ${{ number_format($product->price, 2) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

