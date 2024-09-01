@extends('layouts.app')

@section('content')
    <h1>Edit Customer</h1>
    <div class="card p-3">
        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ $customer->name }}"
                        required>
                </div>
                <div class="form-group col-sm-6">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" class="form-control" id="phone" value="{{ $customer->phone }}">
                </div>
                <div class="form-group col-sm-6">
                    <label for="address">Address</label>
                    <input type="text" name="address" class="form-control" id="address"
                        value="{{ $customer->address }}">
                </div>
                <div class="form-group col-sm-6">
                    <label for="status">Select Status:</label>
                    <select id="status" class="form-control" name="status">
                        <option value="notseen">Not Seen</option>
                        <option value="contacted">Contacted</option>
                        <option value="inprogress" selected>In Progress</option> <!-- Pre-selected option -->
                        <option value="resolved">Resolved</option>
                        <option value="fake">Fake</option>
                        <option value="converted">Converted</option>
                        <option value="giventime">Given Time</option>
                        <option value="needtofollow">Need to Follow</option>
                        <option value="providedestimate">Provided Estimate</option>
                        <option value="runningsites">Running Sites</option>
                    </select>
                </div>

                <div class="form-group col-sm-4">
                    <label for="budget">Budget</label>
                    <input type="text" name="budget" class="form-control" id="budget"
                        value="{{ $customer->budget }}">
                </div>
                <div class="form-group col-sm-4">
                    <label for="follow_up_date">Follow-Up Date</label>
                    <input type="datetime-local" name="follow_up_date" class="form-control" id="follow_up_date"
                        value="{{ $customer->follow_up_date }}">
                </div>
                <div class="form-group col-sm-4">
                    <label for="user_id">Assign User</label>
                    <select name="user_id" id="" class="form-control">
                        <option value="">Select User</option>
                        @foreach ($users as $user)
                            <option @if ($user->id == $customer->user_id) selected @endif value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
              
                <div class="form-group col-sm-6">
                    <label for="longitude">Longitude</label>
                    <input type="text" name="longitude" class="form-control" id="longitude"
                        value="{{ $customer->longitude }}">
                </div>
                <div class="form-group col-sm-6">
                    <label for="latitude">Latitude</label>
                    <input type="text" name="latitude" class="form-control" id="latitude"
                        value="{{ $customer->latitude }}">
                </div>
                <div class="form-group col-sm-12">
                    <label for="problem">Problem</label>
                    <textarea name="problem" class="form-control" id="problem">{{ $customer->problem }}</textarea>
                </div>
                <div class="form-group col-sm-12">
                    <label for="note">Note</label>
                    <textarea name="note" class="form-control" id="note">{{ $customer->note }}</textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
