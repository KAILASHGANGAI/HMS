@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Contractor</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card p-3">
            <form action="{{ route('contractors.update', $contractor->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-sm-6 my-2">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $contractor->name }}"
                            required>
                    </div>
    
                    <div class="col-sm-6 my-2">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ $contractor->phone }}">
                    </div>
    
                    <div class="col-sm-6 my-2">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ $contractor->address }}">
                    </div>
    
                    <div class="col-sm-6 my-2">
                        <label for="work_area" class="form-label">Work Area</label>
                        <textarea class="form-control" id="work_area" name="work_area">{{ $contractor->work_area }}</textarea>
                    </div>
    
                    <div class="col-sm-6 my-2">
                        <label for="note" class="form-label">Note</label>
                        <textarea class="form-control" id="note" name="note">{{ $contractor->note }}</textarea>
                    </div>
    
                    <div class="col-sm-6 my-2">
                        <label for="rate" class="form-label">Rate</label>
                        <input type="text" class="form-control" id="rate" name="rate"
                            value="{{ $contractor->rate }}">
                    </div>
    
                    <div class="col-sm-6 my-2">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="1" {{ $contractor->status == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $contractor->status == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
    
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
