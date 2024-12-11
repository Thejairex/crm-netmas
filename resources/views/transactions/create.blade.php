@extends('services.layout')

@section('title', 'Buy Service')

@section('content')
    <h1>Buy {{ $service->name }}</h1>
    <p><strong>Price:</strong> ${{ $service->price }}</p>
    <p><strong>Discount:</strong> {{ $service->discount }}%</p>
    <p><strong>Total:</strong> ${{ $service->price - ($service->price * ($service->discount / 100)) }}</p>

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        <input type="hidden" name="service_id" value="{{ $service->id }}">
        <label for="payment_method">Payment Method:</label>
        <select name="payment_method" id="payment_method" required>
            <option value="cash">Moneda Nacional</option>
            <option value="crypto">Criptomonedas</option>
            <option value="point">Puntos</option>
        </select>
        <button type="submit">Confirm Purchase</button>
    </form>
@endsection