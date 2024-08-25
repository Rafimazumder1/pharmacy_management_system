@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Approval Requisitions for APPR_2</h1>

        @if($requisitions->isEmpty())
            <p>No requisitions found for approval.</p>
        @else
            <form method="POST" action="{{ route('requisitions.updateApproval_appr2') }}">
                @csrf

                <!-- Master dropdown to set all approval statuses -->
                <div class="form-group d-flex align-items-center">
                    <label for="masterApprovalStatus" class="mr-2">Set All Approval Status:</label>
                    <select id="masterApprovalStatus" class="form-control mr-2" onchange="setAllApprovalStatuses(this.value)">
                        <option value="">Set All Approval Status...</option>
                        <option value="Y">Yes</option>
                        <option value="N">No</option>
                        <option value="C">Cancel</option>
                    </select>
                    
                    <!-- Save All button -->
                    <button type="button" class="btn btn-success" onclick="saveAllStatuses()">Save All</button>
                </div>

                <table class="table table-striped table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>Requisition ID</th>
                            <th>Approval Status (APPR_2)</th>
                            <th>Details</th>
                            <th>Save</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requisitions as $requisition)
                            <tr>
                                <td>{{ $requisition->id }}</td>

                                <td>
                                    <select name="approval_status[{{ $requisition->id }}]" class="form-control approval-status">
                                        <option value="Y" {{ $requisition->appr_2 == 'Y' ? 'selected' : '' }}>Yes</option>
                                        <option value="N" {{ $requisition->appr_2 == 'N' ? 'selected' : '' }}>No</option>
                                        <option value="C" {{ $requisition->appr_2 == 'C' ? 'selected' : '' }}>Cancel</option>
                                    </select>
                                </td>

                                <td>
                                    <a href="{{ route('requisitions.details', ['id' => $requisition->id]) }}" class="btn btn-primary">Details</a>
                                </td>

                                <td>
                                    <button type="submit" class="btn btn-success">Save</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
        @endif
    </div>

    <script>
        // JavaScript function to set all approval statuses
        function setAllApprovalStatuses(value) {
            // Get all dropdowns with the class 'approval-status'
            const approvalDropdowns = document.querySelectorAll('.approval-status');
            // Loop through each dropdown and set its value to the selected one
            approvalDropdowns.forEach(function(dropdown) {
                dropdown.value = value;
            });
        }

        // JavaScript function to submit the form when "Save All" is clicked
        function saveAllStatuses() {
            // Find the form element
            const form = document.querySelector('form');
            // Submit the form
            form.submit();
        }
    </script>
@endsection
