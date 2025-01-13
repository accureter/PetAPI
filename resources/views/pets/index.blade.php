@extends('layouts.app')
@section('content')
<h1>Pet Store - Pets (Status: {{ ucfirst($status) }})</h1>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif
@if($errors->any())
    @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
@endif

<a href="{{ route('pets.add') }}">Add Pet</a>

<form method="GET" action="{{ route('pets.index') }}">
    <label for="status">Filter by Status:</label>
    <select name="status" id="status" onchange="this.form.submit()">
        <option value="available" {{ $status === 'available' ? 'selected' : '' }}>Available</option>
        <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="sold" {{ $status === 'sold' ? 'selected' : '' }}>Sold</option>
    </select>
</form>

@if (count($pets) > 0)
    <ul>
        @foreach ($pets as $pet)
            <li>
                <strong>{!! $pet['name'] ?? '<i>Not found name</i>' !!}</strong> (ID: {{ $pet['id'] ?? 'Not found ID' }})
                <a href="{{route('pets.show', ['id' => $pet['id']])}}">View</a>
                <a href="{{route('pets.edit', ['id' => $pet['id']])}}">Edit</a>
                <form style="display:inline;" action="{{route('pets.destroy', ['id' => $pet['id']])}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@else
    <p>No pets found for the selected status.</p>
@endif
@endsection
