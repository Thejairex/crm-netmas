@extends('services.layout')

@section('title', 'Transactions')

@section('content')
    <h1>Your Transactions</h1>
    <table>
        <thead>
            <tr>
                <th>Service</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->service->name }}</td>
                    <td>${{ $transaction->amount }}</td>
                    <td>{{ ucfirst($transaction->payment_method) }}</td>
                    <td>{{ ucfirst($transaction->status) }}</td>
                    <td>{{ $transaction->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
