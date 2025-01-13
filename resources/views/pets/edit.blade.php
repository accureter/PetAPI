@extends('layouts.app')
@section('content')
<h1>Pet Store - Edit Pet</h1>
<form method="POST" action="{{ route('pets.update', ['id' => $pet['id']]) }}">
    @method('PUT')
    @csrf
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="{{ $pet['name'] }}" required>
    <label for="status">Status:</label>
    <select name="status" id="status" required>
        <option value="available" {{ $pet['status'] === 'available' ? 'selected' : '' }}>Available</option>
        <option value="pending" {{ $pet['status'] === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="sold" {{ $pet['status'] === 'sold' ? 'selected' : '' }}>Sold</option>
    </select>
    <button type="submit">Update Pet</button>
@endsection
