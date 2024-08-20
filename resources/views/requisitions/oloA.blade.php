

@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('requisitions.update', $requisition->req_id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <!-- Display the Requisition ID as read-only -->
                <div class="form-group">
                    <label for="req_id">Requisition ID</label>
                    <input type="text" class="form-control" id="req_id" value="{{ $requisition->req_id }}" readonly>
                </div>

                <!-- Display the Medicine Name -->
                @foreach ($requisition->medicines as $medicineItem)
                    <div class="form-group">
                        <label for="medicine_id">Medicine</label>
                        <input type="text" class="form-control" value="{{ $medicineItem->medicine ? $medicineItem->medicine->name : 'N/A' }}" readonly>
                    </div>
                @endforeach

                <!-- Dropdown to select a new medicine -->
                <div class="form-group">
                    <label for="new_medicine_id">Select New Medicine</label>
                    <select name="new_medicine_id" id="new_medicine_id" class="form-control">
                        <option value="">Select Medicine</option>
                        @foreach ($medicines as $medicine)
                            <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Input for Requisition Quantity -->
                <div class="form-group">
                    <label for="qty">Quantity</label>
                    <input type="text" name="qty" id="qty" class="form-control" value="{{ $requisition->medicines[0]->qty }}" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
 </div>
@endsection
