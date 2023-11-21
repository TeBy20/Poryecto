<!-- resources/views/users/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>User List</h1>

    @foreach($users as $user)
        <p>{{ $user->name }}</p>
        <a href="{{ route('users.show', $user->id) }}">Show</a>
        <a href="{{ route('users.edit', $user->id) }}">Edit</a>

        <!-- Form for deleting the user -->
        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    @endforeach
@endsection
