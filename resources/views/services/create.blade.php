@extends('layouts.app')

@section('title', 'Add Service')

@section('content')
    <h1>Add Service</h1>
    <form action="{{ route('services.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" required>

        <label for="discount">Discount (%):</label>
        <input type="number" name="discount" id="discount" min="0" max="100">

        <button type="submit">Save</button>
    </form>
@endsection
