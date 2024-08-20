@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Requisition Details for ID: {{ $requisition->id }}</h1>

        <!-- Display success or error messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form to edit requisition details -->
        <form method="POST" action="{{ route('requisitions.updateDetails', $requisition->id) }}">
            @csrf
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Medicine Name</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requisitionDetails as $detail)
                        <tr>
                            <td>
                                <select name="details[{{ $detail->medicine_id }}][medicine_id]" class="form-control">
                                    @foreach($medicines as $medicine)
                                        <option value="{{ $medicine->id }}" {{ $medicine->id == $detail->medicine_id ? 'selected' : '' }}>
                                            {{ $medicine->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="details[{{ $detail->medicine_id }}][qty]" value="{{ $detail->qty }}" class="form-control" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="btn btn-success mt-3">Save Changes</button>
        </form>
    </div>
@endsection
