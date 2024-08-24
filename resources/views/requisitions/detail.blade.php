@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Requisitions</h1>

        @if($requisitions->isEmpty())
            <p>No requisitions found for your shop with APPR_1 = 'N'.</p>
        @else
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Requisition ID</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requisitions as $requisition)
                        <tr>
                            <td>{{ $requisition->id }}</td>
                            <td>
                                <a href="{{ route('requisitions.details', ['id' => $requisition->id]) }}" class="btn btn-primary">Details</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
