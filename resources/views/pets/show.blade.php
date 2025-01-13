@extends('layouts.app')
@section('content')
<h1>Pet Store - Pet Details</h1>
@if(session('success'))
    <p>{{ session('success') }}</p>
@endif
@if($errors->any())
    @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
@endif
<h2>{{ $pet['name'] }}</h2>
<p>ID: {{ $pet['id'] }}</p>
<p>Status: {{ ucfirst($pet['status']) }}</p>
<a href="{{ route('pets.index', ['status' => $pet['status']]) }}">Back to List</a>

@endsection
