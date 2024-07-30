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

                <form action="{{ route('requisitions.update', $requisition->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="medicine_id">Medicine</label>
                        <input type="text" class="form-control"
                            value="{{ $requisition->medicine ? $requisition->medicine->name : 'N/A' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="new_medicine_id">Select New Medicine</label>
                        <select name="new_medicine_id" id="new_medicine_id" class="form-control">
                            <option value="">Select Medicine</option>
                            @foreach ($medicines as $medicine)
                                <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="qty">Requisition No</label>
                        <input type="text" name="qty" id="qty" class="form-control"
                            value="{{ $requisition->qty }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
