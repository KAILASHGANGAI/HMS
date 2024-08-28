@extends('layouts.app')

@section('content')
    <h1>Customers</h1>
    <a href="{{ route('customers.create') }}" class="btn btn-primary">Create New Customer</a>
    @include('customers.customers-details')

  
@endsection
