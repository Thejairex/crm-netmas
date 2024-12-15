@extends('services.layout')

@section('title', 'Services')

@section('content')
    <h1>Services</h1>
    @if (Auth::user()->isAdmin())
        <a href="{{ route('services.create') }}" class="btn btn-primary">Add Service</a>
    @endif
    @if ($services->isEmpty())
        <h3>No services found.</h3>
    @else
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
            <tr>
                <td>{{ $service->name }}</td>
                    <td>{{ $service->description }}</td>
                    <td>${{ $service->price }}</td>
                    <td>{{ $service->discount }}%</td>
                    <td>
                        @if (Auth::user()->isAdmin())
                        <a href="{{ route('services.edit', $service) }}">Edit</a>
                        <form action="{{ route('services.destroy', $service) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                        @endif

                        <a href="{{ route('transactions.create', $service) }}">Buy</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
@endsection
