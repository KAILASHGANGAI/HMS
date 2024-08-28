@extends('layouts.app')

@section('content')
<div class="container">
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#createDepositModal">
        Add Deposit
    </button>

    <!-- Table to display deposits -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deposits as $deposit)
            <tr>
                <td>{{ $deposit->id }}</td>
                <td>{{ $deposit->customer->name }}</td>
                <td>{{ $deposit->amount }}</td>
                <td>{{ $deposit->deposit_date }}</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editDepositModal-{{ $deposit->id }}">
                        Edit
                    </button>
                    <form action="{{ route('deposits.destroy', $deposit) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>

            <!-- Edit Deposit Modal -->
            <div class="modal fade" id="editDepositModal-{{ $deposit->id }}" tabindex="-1" role="dialog" aria-labelledby="editDepositModalLabel-{{ $deposit->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editDepositModalLabel-{{ $deposit->id }}">Edit Deposit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('deposits.update', $deposit) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="customer_id">Customer</label>
                                    <select name="customer_id" class="form-control" required>
                                        @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ $deposit->customer_id == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" name="amount" class="form-control" step="0.01" value="{{ $deposit->amount }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="deposit_date">Deposit Date</label>
                                    <input type="date" name="deposit_date" class="form-control" value="{{ $deposit->deposit_date }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="receipt">Receipt </label>
                                    <input type="file" name="receipt" class="form-control" value="{{ $deposit->receipt }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="note">Note</label>
                                    <textarea class="form-control" name="note" id="">{{ $deposit->note }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>

    <!-- Create Deposit Modal -->
    <div class="modal fade" id="createDepositModal" tabindex="1" role="dialog" aria-labelledby="createDepositModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createDepositModalLabel">Create Deposit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('deposits.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="customer_id">Customer</label>
                            <select name="customer_id" class="form-control" required>
                                @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" class="form-control" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="deposit_date">Deposit Date</label>
                            <input type="date" name="deposit_date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="receipt">Receipt </label>
                            <input type="file" name="receipt" class="form-control" value="{{ $deposit->receipt }}" required>
                        </div>
                        <div class="form-group">
                            <label for="note">Note</label>
                            <textarea class="form-control"   name="note" id=""></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
