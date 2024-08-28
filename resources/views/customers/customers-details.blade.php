@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <table id="customer-table" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Follow Up Date</th>
                    <th>Actions</th>
                </tr>
            </thead>


        </table>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#customer-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('customers.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'phone',
                        name: 'Phone'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'follow_up_date',
                        name: 'follow_up_date'
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


        function getLocation(id) {

            var customerId = id;

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;

                    updateCustomer(customerId, {
                        longitude: longitude,
                        latitude: latitude,
                        _token: '{{ csrf_token() }}'
                    });
                    window.location.reload();
                }, function(error) {
                    alert('Error getting location: ' + error.message);
                });
            } else {
                alert('Geolocation is not supported by this browser.');
            }

            

        }

        function updateCustomer(id, data) {
                $.ajax({
                    url: '/customers-update/' + id,
                    method: 'PUT',
                    data: data,
                    success: function(response) {
                        console.log(response);
                        // Optionally, update the UI to reflect the change
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }
    </script>
@endsection
