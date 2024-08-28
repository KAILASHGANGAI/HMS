@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Contractor</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <div class="card">
            <form action="{{ route('contractors.store') }}" class="card-body p-4" method="POST">
                @csrf
                    <div class="row">
                        <div class="col-sm-6 my-1">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                
                        <div class="col-sm-6 my-1">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                
                        <div class="col-sm-6 my-1">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                
                        <div class="col-sm-6 my-1">
                            <label for="work_area" class="form-label">Work Area</label>
                            <textarea class="form-control" id="work_area" name="work_area"></textarea>
                        </div>
                
                        <div class="col-sm-6 my-1">
                            <label for="note" class="form-label">Note</label>
                            <textarea class="form-control" id="note" name="note"></textarea>
                        </div>
                
                        <div class="col-sm-6 my-1">
                            <label for="rate" class="form-label">Rate</label>
                            <input type="text" class="form-control" id="rate" name="rate">
                        </div>
                
                        <div class="col-sm-6 my-1">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
        
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
</div>
@endsection
