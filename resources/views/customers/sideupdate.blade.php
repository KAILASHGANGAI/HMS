@extends('layouts.app')

@section('content')
<div class="container">
  <div class=" p-3">
  <div class="row">
    <div class="col-sm-6 mx-auto card shadow p-3">
        <a href="/" class="btn btn-secondary">Back</a>
        <form action="{{ route('cupdate', $customer->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label for="customer_id">Customer</label>
                    <input type="text" name="customer_id" class="form-control"
                        value="{{ $customer->name }}" disabled>
                    </select>
                </div>
                <div class="form-group ">
                    <label for="status">Select Status:</label>
                    <select id="status" class="form-control" name="status">
                        <option {{ $customer->status == 'notseen' ? 'selected' : '' }}
                            value="notseen">Not Seen</option>
                        <option {{ $customer->status == 'contacted' ? 'selected' : '' }}
                            value="contacted">Contacted</option>
                        <option {{ $customer->status == 'inprogress' ? 'selected' : '' }}
                            value="inprogress" selected>In Progress</option>
                        <!-- Pre-selected option -->
                        <option {{ $customer->status == 'resolved' ? 'selected' : '' }}
                            value="resolved">Resolved</option>
                        <option {{ $customer->status == 'fake' ? 'selected' : '' }}
                            value="fake">Fake</option>
                        <option {{ $customer->status == 'converted' ? 'selected' : '' }}
                            value="converted">Converted</option>
                        <option {{ $customer->status == 'giventime' ? 'selected' : '' }}
                            value="giventime">Given Time</option>
                        <option {{ $customer->status == 'needtofollow' ? 'selected' : '' }}
                            value="needtofollow">Need to Follow</option>
                        <option {{ $customer->status == 'providedestimate' ? 'selected' : '' }}
                            value="providedestimate">Provided Estimate</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="budget">Images</label>
                    <input type="file" name="images[]" multiple class="form-control">
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between mt-3">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
  </div>
  </div>
</div>
@endsection