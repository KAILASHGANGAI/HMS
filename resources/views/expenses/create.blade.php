@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Expense 


        </h1>
        <form action="{{ route('expenses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="mb-3 col-sm-6">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name"  name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 col-sm-6">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" required step="0.01">
                    @error('amount')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 col-sm-6">
                    <label for="expense_date" class="form-label">Expense Date</label>
                    <input type="date" class="form-control" id="expense_date" value="{{ old('expense_date') }}" name="expense_date">
                    @error('expense_date')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 col-sm-6">
                    <label for="bill_image" class="form-label">Bill Image</label>
                    <input type="file" class="form-control" id="bill_image" value="{{ old('bill_image') }}" name="bill_image">
                    @error('bill_image')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 col-sm-6">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" >{{ old('description') }}</textarea>
                    @error('description')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Add Expense</button>
            </div>
        </form>
    </div>
@endsection
