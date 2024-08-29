@extends('layouts.app')

@section('content')
<div class="container">
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#createDepositModal">
        Add Deposit
    </button>

    <div class="table table-responsive">
        <!-- Table to display deposits -->
    <table class="table table-bordered" id="deposit-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Receipt</th>
                <th>Actions</th>
            </tr>
        </thead>
  
    </table>
    </div>

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
                <form action="{{ route('deposits.store') }}" method="POST" enctype="multipart/form-data">
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
                            <input type="file" name="image" class="form-control" value="" required>
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

@section('scripts')
<script>
       $(document).ready(function() {
            $('#deposit-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('deposits.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'customer',
                        name: 'customer'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'deposit_date',
                        name: 'deposit_date'
                    },
                    {
                        data: 'receipt',
                        name: 'receipt'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
</script>
@endsection
