@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Expenses</h1>
        <a href="{{ route('expenses.create') }}" class="btn btn-primary">Add Expense</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Bill Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($expenses as $expense)
                    <tr>
                        <td>{{ $expense->id }}</td>
                        <td>{{ $expense->name }}</td>
                        <td>{{ $expense->description }}</td>
                        <td>{{ $expense->amount }}</td>
                        <td>{{ $expense->expense_date }}</td>
                        <td>
                            @if ($expense->bill_Image)
                                <a href="{{ asset($expense->bill_Image) }}" target="_blank">
                                    <img src="{{ asset($expense->bill_Image) }}" alt="Bill Image"
                                        style="width: 60px; height: 40px">

                                </a>
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
