@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Contractors</h2>
    <a href="{{ route('contractors.create') }}" class="btn btn-primary mb-3">Add Contractor</a>

   <div class="table table-responsive">
    <table class="table table-bordered" id="contractors-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Work Area</th>
                <th>Rate</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
   </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#contractors-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('contractors.index') }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'phone', name: 'phone' },
            { data: 'address', name: 'address' },
            { data: 'work_area', name: 'work_area' },
            { data: 'rate', name: 'rate' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        order: [[0, 'desc']],
        responsive: true
    });
});
</script>
@endsection
