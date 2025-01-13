@extends('layouts.app')
@section('content')
<h1>Pet Store - Add Pet</h1>
<form method="POST" action="{{ route('pets.store') }}">
    @csrf
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>
    <label for="status">Status:</label>
    <select name="status" id="status" required>
        <option value="available">Available</option>
        <option value="pending">Pending</option>
        <option value="sold">Sold</option>
    </select>
    <button type="submit">Add Pet</button>
@endsection
