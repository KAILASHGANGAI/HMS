@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>{{ $contractor->name }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Phone:</strong> {{ $contractor->phone ?? 'N/A' }}</p>
            <p><strong>Address:</strong> {{ $contractor->address ?? 'N/A' }}</p>
            <p><strong>Work Area:</strong> {{ $contractor->work_area ?? 'N/A' }}</p>
            <p><strong>Note:</strong> {{ $contractor->note ?? 'N/A' }}</p>
            <p><strong>Rate:</strong> {{ $contractor->rate ?? 'N/A' }}</p>
            <p><strong>Status:</strong> {{ $contractor->status == '1' ? 'Active' : 'Inactive' }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('contractors.edit', $contractor->id) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('contractors.destroy', $contractor->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this contractor?');">Delete</button>
            </form>
            <a href="{{ route('contractors.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection
