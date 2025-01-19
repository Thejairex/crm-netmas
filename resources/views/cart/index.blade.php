<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($cart->items->isNotEmpty())
                        <table class="table-auto w-full">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2">{{ __('Product') }}</th>
                                    <th class="px-4 py-2">{{ __('Price') }}</th>
                                    <th class="px-4 py-2">{{ __('Quantity') }}</th>
                                    <th class="px-4 py-2">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart->items as $item)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $item->product->name }}</td>
                                        <td class="border px-4 py-2">{{ $item->product->price }}</td>
                                        <td class="border px-4 py-2">{{ $item->quantity }}</td>
                                        <td class="border px-4 py-2">
                                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">
                                                    {{ __('Remove') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            <a href="{{ route('cart.clear') }}" class="text-red-600 hover:text-red-900">
                                {{ __('Clear cart') }}
                            </a>
                        </div>
                        <div class="mt-4">
                            <form action="{{ route('cart.checkout') }}" method="POST">
                                @csrf
                                <select name="payment_method" id="payment_method" required>
                                    <option value="mercadopago">MercadoPago</option>
                                    <option value="crypto">Cryptocurrencies</option>
                                    <option value="points">Points</option>
                                </select>
                                <button type="submit" class="text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    {{ __('Pay') }}
                                </button>
                            </form>
                        </div>
                    @else
                        <p class="text-center">{{ __('Your cart is empty.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

