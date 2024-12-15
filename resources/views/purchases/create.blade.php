<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buy a Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                    <p><strong>Description:</strong> {{ $product->description }}</p>
                    <p><strong>Price:</strong> ${{ $product->price }}</p>
                    <p><strong>Discount:</strong> {{ $product->discount }}%</p>
                    <p><strong>Total:</strong> ${{ $product->calculateTotalPrice() }}</p>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="/purchases" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <label for="payment_method">Payment Method:</label>
                        <select name="payment_method" id="payment_method" required>
                            <option value="mercadopago">MercadoPago</option>
                            <option value="crypto">Cryptocurrencies</option>
                            <option value="points">Points</option>
                        </select>
                        <x-primary-button>
                            {{ __('Confirm Purchase') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
