@extends('services.layout')

@section('title', 'Edit Service')

@section('content')
    <h1>Edit Service</h1>
    <form action="{{ route('services.update', $service) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $service->name }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control">{{ $service->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" name="price" id="price" value="{{ $service->price }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="discount">Discount:</label>
            <input type="number" name="discount" id="discount" value="{{ $service->discount }}" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection