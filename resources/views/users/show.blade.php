@extends('layouts.app')

@section('content')
    <h1>User Details</h1>
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Admin:</strong> {{ $user->is_admin ? 'Yes' : 'No' }}</p>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users List</a>
@endsection
