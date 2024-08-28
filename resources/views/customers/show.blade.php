@extends('layouts.app')
<style>
    p {
        font-size: 12px;
    }
</style>
@section('content')
    <div class="container mt-5">
        <div class="row mb-3">
            <div class="col-12">
                <h5 class="d-flex justify-content-between align-items-center">
                    Customer Details
                    @if (auth()->user()->is_admin)
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back to Customers List</a>
                    @else
                        <a href="/" class="btn btn-secondary">Back to Customers List</a>
                    @endif
                </h5>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="">
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0">Personal Information</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Name:</strong> {{ $customer->name }}</p>
                                <p><strong>Phone:</strong> <a href="tel:{{ $customer->phone }}">{{ $customer->phone }}</a>
                                </p>
                                <p><strong>Address:</strong> {{ $customer->address }}</p>
                                <p><strong>Status:</strong> {{ ucfirst($customer->status) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="card mb-4">
                            <div class="card-header bg-success text-white">
                                <h5 class="card-title mb-0">Additional Information</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Problem:</strong> {{ $customer->problem }}</p>
                                <p><strong>Follow-Up Date:</strong>
                                    {{ \Carbon\Carbon::parse($customer->follow_up_date)->format('F j, Y') }}</p>
                                <p><strong>User Followed By:</strong> {{ $customer->user->name }}</p>
                                <p><strong>Note:</strong> {{ $customer->note }}</p>
                                <p><strong>Longitude:</strong> {{ $customer->longitude }}</p>
                                <p><strong>Latitude:</strong> {{ $customer->latitude }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class=" col-md-8" id="expenses">
                <div>
                    @if (auth()->user()->is_admin)
                    <h5>Total Deposits: Rs. {{ $customer->deposits->sum('amount') }}</h5>
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                
                            @foreach($customer->deposits as $deposit)
                                <tr>
                                    <td>{{ $deposit->id }}</td>
                                    <td>{{ $deposit->amount }}</td>
                                    <td>{{ $deposit->created_at }}</td>
                                </tr>
                            @endforeach
                
                
                        </table>
                    @endif
                </div>
                <h6 class="text-center mt-2">Total Expenses : Rs. {{ $customer->expenses->sum('amount') }}</h6>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Bill</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customer->expenses as $expense)
                            <tr>
                                <td>{{ $expense->id }}</td>
                                <td>{{ $expense->name }}</td>
                                <td>{{ $expense->description }}</td>
                                <td>{{ $expense->amount }}</td>
                                <td><a href="{{ asset($expense->bill_Image) }}" target="_blank" rel="noopener noreferrer">
                                        <img src="{{ asset($expense->bill_Image) }}" alt="Bill Image"
                                            style="width: 60px; height: 40px">
                                    </a></td>
                                <td>{{ $expense->created_at }}</td>
                            </tr>
                        @endforeach
                </table>

            </div>
        </div>

        <div class="images row">
            <h5>Images</h5>
            @foreach ($customer->images as $image)
            @if (file_exists(public_path($image->image)))
                <div class="image col-sm-2  shadow">
                    <a href="{{ asset($image->image) }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset($image->image) }}" alt="Image" class="img-fluid" style="height: 100px; width:100%" >
                    </a>
                </div>
                @endif
            @endforeach
        </div>

    </div>
@endsection
