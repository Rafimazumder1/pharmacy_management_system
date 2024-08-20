@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Requisitions</h1>

        <!-- Filter Form for Shop and APPR_1 -->
        <form method="GET" action="{{ route('requisitions.byShop') }}" class="form-inline mb-4">
            <div class="form-group mr-3">
                <label for="shop_id" class="mr-2">Select Shop:</label>
                <select name="shop_id" id="shop_id" class="form-control" onchange="this.form.submit()">
                    @foreach($shops as $shop)
                        <option value="{{ $shop->id }}" {{ $shopId == $shop->id ? 'selected' : '' }}>
                            {{ $shop->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="appr" class="mr-2">Filter by Approval Status (APPR_1):</label>
                <select name="appr" id="appr" class="form-control" onchange="this.form.submit()">
                    <option value="N" {{ $approvalStatus == 'N' ? 'selected' : '' }}>Not Approved (N)</option>
                    <option value="Y" {{ $approvalStatus == 'Y' ? 'selected' : '' }}>Approved (Y)</option>
                </select>
            </div>
        </form>

        @if($requisitions->isEmpty())
            <p>No requisitions found for the selected shop with APPR_1 = '{{ $approvalStatus }}'.</p>
        @else
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Requisition ID</th>
                        {{-- <th>Approval Status (APPR_1)</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requisitions as $requisition)
                        <tr>
                            <td>{{ $requisition->id }}</td>
                            {{-- <td>{{ $requisition->appr_1 }}</td> --}}
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
