@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Expenses</h1>
        <a href="{{ route('expenses.create') }}" class="btn btn-primary">Add Expense</a>
        <div class="table table-responsive">
            <table class="table mt-3" id="expense-table">
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
             
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#expense-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('expenses.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'expense_date',
                        name: 'expense_date'
                    },
                    {
                        data: 'bill_Image',
                        name: 'bill_Image'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ],
                responsive: true
            });
        });
    </script>
@endsection
