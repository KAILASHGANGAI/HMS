@extends('layouts.app')
@section('content')
    <div class="container-fluid ">
        <div class="table-responsive">
            <table id="customer-table" class="table tabe-striped table-responsive">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Problem</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>VisitDate</th>
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
            
            $('#customer-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('myCustomers') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'problem',
                        name: 'problem',
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
                        data: 'follow_up_date',
                        name: 'follow_up_date'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center  d-flex h-100 ',

                    },
                ],
                responsive: true,
                order: [
                    [0, 'desc']
                ]
            });
        });


        function getLocation(id) {
            // Show confirmation alert
            var confirmAction = confirm("Are you sure you want to update the customer's location?");

            if (confirmAction) {
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

                        // Reload the page after updating
                        window.location.reload();
                    }, function(error) {
                        alert('Error getting location: ' + error.message);
                    });
                } else {
                    alert('Geolocation is not supported by this browser.');
                }
            } else {
                // Action was cancelled
                alert('Action canceled.');
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


        function showLocation(latitudeDes, longitudeDes) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        var latitude = position.coords.latitude;
                        var longitude = position.coords.longitude;

                        // Replace with the destination coordinates
                        var destinationLatitude = latitudeDes; // Example: New York City latitude
                        var destinationLongitude = longitudeDes; // Example: New York City longitude

                        // Construct the Google Maps URL for directions
                        var directionsUrl =
                            `https://www.google.com/maps/dir/?api=1&origin=${latitude},${longitude}&destination=${destinationLatitude},${destinationLongitude}&travelmode=driving`;

                        // Open the Google Maps URL in a new tab
                        window.open(directionsUrl, '_blank');
                    },
                    function(error) {
                        alert('Error getting location: ' + error.message);
                    }
                );
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        }
    </script>
@endsection
