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

                       
                        <form action="{{ route('requisitions.store') }}" method="POST">
                            @csrf
                        
                            <div class="mb-3">
                                <label for="req_id" class="form-label">Requisition ID</label>
                                <input type="text" class="form-control" id="req_id" name="req_id" value="{{ $req_id ?? old('req_id') }}" required>
                            </div>
                        
                            <div id="medicine-wrapper">
                                <div class="medicine-item mb-3">
                                    <label for="medicine" class="form-label">Medicine</label>
                                    <select class="form-control" name="medicines[0][medicine_id]" required>
                                        <option value="">Select Medicine</option>
                                        @foreach ($medicines as $medicine)
                                            <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                                        @endforeach
                                    </select>
                        
                                    <label for="qty" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" name="medicines[0][qty]" required>
                                </div>
                            </div>
                        
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        
                        <!-- Button to reset req_id -->
                        {{-- <a href="{{ route('requisitions.reset') }}" class="btn btn-warning">Reset Requisition ID</a> --}}
                        
                        
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const reqIdInput = document.getElementById('req_id');
                                const resetButton = document.querySelector('.btn-warning');
                                
                                resetButton.addEventListener('click', function () {
                                    reqIdInput.removeAttribute('readonly');
                                });
                            });
                        </script>
                        
                        
                        
                       
                        
                        
                        

                        <script>
                            let medicineIndex = 1;

                            function addMedicineField() {
                                const wrapper = document.getElementById('medicine-wrapper');
                                const newMedicineItem = document.createElement('div');
                                newMedicineItem.classList.add('medicine-item', 'mb-3');

                                newMedicineItem.innerHTML = `
                                    <label for="medicine" class="form-label">Medicine</label>
                                    <select class="form-control" name="medicines[${medicineIndex}][medicine_id]" required>
                                        <option value="">Select Medicine</option>
                                        @foreach ($medicines as $medicine)
                                            <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                                        @endforeach
                                    </select>
                        
                                    <label for="qty" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" name="medicines[${medicineIndex}][qty]" required>
                                `;

                                wrapper.appendChild(newMedicineItem);
                                medicineIndex++;
                            }
                        </script>

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
                            {{-- <th>Requisition ID</th> --}}
                            <th>Medicine</th>
                            <th>Quantity</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (session()->get('temporary_requisitions', []) as $requisition)
                            @if (isset($requisition['medicines']))
                                @foreach ($requisition['medicines'] as $medicine)
                                    <tr>
                                        <!-- Display medicine name -->
                                        <td>{{ $medicines->find($medicine['medicine_id'])->name ?? 'N/A' }}</td>
                                        <!-- Display quantity -->
                                        <td>{{ $medicine['qty'] }}</td>
                                        <!-- Action buttons -->
                                        {{-- <td>
                                            <!-- Edit Button -->
                                            <a href="{{ route('requisitions.edit', ['req_id' => $requisition['req_id']]) }}"
                                                class="btn btn-primary">Edit</a>

                                            <!-- Delete Button -->
                                            <form
                                                action="{{ route('requisitions.destroy', ['req_id' => $requisition['req_id']]) }}"
                                                method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>

                <!-- Form to finalize requisitions -->
                <form action="{{ route('requisitions.save') }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"></script>
    <script>
        $(document).ready(function() {
            $('#requisitionsTable').DataTable();
        });

        // Clear requisition list from session storage on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Clear session storage
            // sessionStorage.removeItem('temporary_requisitions'); // Uncomment if using sessionStorage
        });
    </script>
@endpush
