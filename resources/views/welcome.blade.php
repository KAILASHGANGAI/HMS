@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Auth::user()->is_admin)
            <div class="row">
                <!-- Customers Card -->
                <div class="col-sm-3">
                    <div class="card border-primary shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title text-primary">Customers</h5>
                            <p class="card-text  text-primary">{{ $customers }}</p>
                        </div>
                        <div class="card-footer bg-primary text-white text-center">
                            <small>Active Customers</small>
                        </div>
                    </div>
                </div>

                <!-- Expenses Card -->
                <div class="col-sm-3">
                    <div class="card border-danger shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title text-danger">Expenses</h5>
                            <p class="card-text  text-danger">{{ $expenses }}</p>
                        </div>
                        <div class="card-footer bg-danger text-white text-center">
                            <small>Total Expenses</small>
                        </div>
                    </div>
                </div>

                <!-- Users Card -->
                <div class="col-sm-3">
                    <div class="card border-success shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title text-success">Users</h5>
                            <p class="card-text  text-success">{{ $users }}</p>
                        </div>
                        <div class="card-footer bg-success text-white text-center">
                            <small>Registered Users</small>
                        </div>
                    </div>
                </div>

                <!-- customers Card -->
                <div class="col-sm-3">
                    <div class="card border-warning shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title text-warning">customers</h5>
                            <p class="card-text  text-warning">{{ $customers }}</p>
                        </div>
                        <div class="card-footer bg-warning text-white text-center">
                            <small>Total customers</small>
                        </div>
                    </div>
                </div>
            </div>
        @else
           @include('customers.customers-details')
        @endif
    </div>
    
@endsection
