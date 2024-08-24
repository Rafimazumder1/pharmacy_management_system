@extends('layouts.app')

@section('content')

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
                            <th>Requisition ID</th>
                            <th>Medicine</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (session()->get('temporary_requisitions', []) as $requisition)
                            @if (isset($requisition['medicines']))
                                @foreach ($requisition['medicines'] as $index => $medicine)
                                    <tr>
                                        <!-- Display the req_id only for the first medicine in the group -->
                                        @if ($index == 0)
                                            <td rowspan="{{ count($requisition['medicines']) }}">
                                                {{ $requisition['req_id'] }}</td>
                                        @endif
                                        <td>{{ $medicines->find($medicine['medicine_id'])->name ?? 'N/A' }}</td>
                                        <td>{{ $medicine['qty'] }}</td>
                                        <!-- Action buttons only for the first medicine row -->
                                        @if ($index == 0)
                                            <td rowspan="{{ count($requisition['medicines']) }}">
                                                <!-- Edit Button -->
                                                <a href="{{ route('requisitions.edit', ['req_id' => $requisition['req_id']]) }}"
                                                    class="btn btn-primary">Edit</a>

                                                <!-- Delete Button -->
                                                <form
                                                    action="{{ route('requisitions.destroy', ['req_id' => $requisition['req_id']]) }}"method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>


                <!-- Form to finalize requisitions -->
                <form action="{{ route('requisitions.finalize') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Finalize Requisitions</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection