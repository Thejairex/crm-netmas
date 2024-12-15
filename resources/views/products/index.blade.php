<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (Auth::user()->isAdmin())
                    <div class="p-6 bg-white border-b border-gray-200">
                        <a href="/products/create"
                            class="mt-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Create new product
                        </a>
                    </div>
                @endif
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Description</th>
                                <th class="px-4 py-2">Price</th>
                                <th class="px-4 py-2">Discount</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="border px-4 py-2">{{ $product->name }}</td>
                                    <td class="border px-4 py-2">{{ $product->description }}</td>
                                    <td class="border px-4 py-2">{{ $product->price }}</td>
                                    <td class="border px-4 py-2">{{ $product->discount }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('purchases.create', $product) }}"
                                            class="text-green-500 hover:text-green-700 underline">Buy</a>
                                        @if (Auth::user()->isAdmin())
                                            <a href="{{ route('products.edit', $product) }}"
                                                class="text-blue-500 hover:text-blue-700 underline">Edit</a>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-500 hover:text-red-700 underline">Delete</button>
                                            </form>
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
