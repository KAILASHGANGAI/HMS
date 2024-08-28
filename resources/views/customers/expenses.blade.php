@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
        <div class="col-sm-6 mx-auto card shadow p-3">
            <a href="/" class="btn btn-secondary">Back</a>
            <h6 class="text-center mt-2">Add Expenses for {{ $customer->name }}</h6>
            <form action="{{ route('customer-expenses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="customer_id">Customer</label>
                        <input type="text" name="customer_id" class="form-control" value="{{ $customer->name }}" disabled>
                        </select>
                        <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                    </div>
                    <div class="form-group ">
                        <label for="status">Expenses Type:</label>
                        <input type="text" name="name" class="form-control">
    
                    </div>
                    <div class="form-group ">
                        <label for="status">Amount:</label>
                        <input type="text" name="amount" class="form-control" required minlength="1">
    
                    </div>
                    <div class="form-group ">
                        <label for="status">Date:</label>
                        <input type="date" name="date" class="form-control">
    
                    </div>
                    <div class="form-group">
                        <label for="budget">Image</label>
                        <input type="file" name="bill_image" class="form-control">
                    </div>
                </div>
                <div class="modal-footer mt-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
      </div>
    </div>
@endsection
