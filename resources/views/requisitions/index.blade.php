@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Add Requisition
                    </div>
                    <div class="card-body">
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

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('requisitions.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Add select input field for medicine -->
                            <div class="mb-3">
                                <label for="medicine" class="form-label">Medicine</label>
                                <select class="form-control" id="medicine" name="medicine_id" required>
                                    <option value="">Select Medicine</option>
                                    @foreach ($medicines as $medicine)
                                        <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Input field for the requisition quantity -->
                            <div class="mb-3">
                                <label for="qty" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="qty" name="qty" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Requisition</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Requisitions List
                    </div>
                    <div class="card-body">
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

                        <table id="requisitionsTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Medicine</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requisitions as $requisition)
                                    <tr>
                                        <td>{{ $requisition->id }}</td>
                                        <td>{{ $requisition->medicine ? $requisition->medicine->name : 'N/A' }}</td>
                                        <td>{{ $requisition->qty }}</td>
                                        <td>
                                            <a href="{{ route('requisitions.edit', $requisition->id) }}"
                                                class="btn btn-primary" style="color:white;">Edit</a>
                                            <form action="{{ route('requisitions.destroy', $requisition->id) }}"
                                                method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure?')"
                                                    style="color:white;">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#requisitionsTable').DataTable();
        });
    </script>
@endpush
