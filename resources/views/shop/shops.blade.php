{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Add Shop Form -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Add Shop
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('shops.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" required></textarea>
                            </div>
                            <!-- Division -->
                            <div class="mb-3">
                                <label for="division" class="form-label">Division</label>
                                <select class="form-control" id="division" name="division" required>
                                    <option value="">Select Division</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        <!-- District -->
                            <div class="mb-3">
                                <label for="district" class="form-label">District</label>
                                <select class="form-control" id="district" name="district" required>
                                    <option value="">Select District</option>
                                    @foreach ($dd as $div)
                                    <option value="{{ $div->id }}">{{ $div->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <!-- Upazilla -->
                            <div class="mb-3">
                                <label for="upazilla" class="form-label">Upazilla</label>
                                <select class="form-control" id="upazilla" name="upazilla" required>
                                    <option value="">Select Upazilla</option>
                                    @foreach ($upzila as $upzillas)
                                    <option value="{{ $upzillas->id }}">{{ $upzillas->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="site_title" class="form-label">Site Title</label>
                                <input type="text" class="form-control" id="site_title" name="site_title">
                            </div>
                            <div class="mb-3">
                                <label for="site_logo" class="form-label">Site Logo</label>
                                <input type="file" class="form-control" id="site_logo" name="site_logo">
                            </div>

                            <button type="submit" class="btn btn-primary">Add Shop</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Shop List -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Shop List
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table id="shopsTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Site Title</th>
                                    <th>Status</th>
                                    <th>Upazilla ID</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shops as $shop)
                                    <tr>
                                        <td>{{ $shop->id }}</td>
                                        <td>{{ $shop->name }}</td>
                                        <td>{{ $shop->phone }}</td>
                                        <td>{{ $shop->site_title }}</td>
                                        <td>{{ $shop->status }}</td>
                                        <td>{{ $shop->upazilla_id }}</td>
                                        <td>
                                            <a href="{{ route('shop.edit', $shop->id) }}" class="btn btn-primary"
                                                style="color:white;">Edit</a>
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
    <!-- Include jQuery if not already included -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#division').on('change', function() {
                var divisionId = $(this).val();
                console.log('Selected Division ID:', divisionId); // Debug line
                if (divisionId) {
                    $.ajax({
                        url: '{{ route('get-districts', '') }}/' + divisionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log('Received Data:', data); // Debug line
                            $('#district').empty();
                            $('#district').append('<option value="">Select District</option>');
                            $.each(data, function(key, value) {
                                $('#district').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error('AJAX Error:', textStatus); // Debug line
                        }
                    });
                } else {
                    $('#district').empty();
                    $('#district').append('<option value="">Select District</option>');
                }
            });
        });
    </script>
@endpush --}}




@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Add Shop Form -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Add Shop
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('shops.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" required></textarea>
                            </div>
                            <!-- Division -->
                            <div class="mb-3">
                                <label for="division" class="form-label">Division</label>
                                <select class="form-control" id="division" name="division" required>
                                    <option value="">Select Division</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- District -->
                            <div class="mb-3">
                                <label for="district" class="form-label">District</label>
                                <select class="form-control" id="district" name="district" required>
                                    <option value="">Select District</option>
                                </select>
                            </div>
                            <!-- Thana -->
                            <div class="mb-3">
                                <label for="Thanas" class="form-label">Thana</label>
                                <select class="form-control" id="Thanas" name="Thanas" required>
                                    <option value="">Select Thana</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="site_title" class="form-label">Site Title</label>
                                <input type="text" class="form-control" id="site_title" name="site_title">
                            </div>
                            <div class="mb-3">
                                <label for="site_logo" class="form-label">Site Logo</label>
                                <input type="file" class="form-control" id="site_logo" name="site_logo">
                            </div>
                        
                            <button type="submit" class="btn btn-primary">Add Shop</button>
                        </form>
                        
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Shop List -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Shop List
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table id="shopsTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Site Title</th>
                                    <th>Status</th>
                                    <th>Upazilla ID</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shops as $shop)
                                    <tr>
                                        <td>{{ $shop->id }}</td>
                                        <td>{{ $shop->name }}</td>
                                        <td>{{ $shop->phone }}</td>
                                        <td>{{ $shop->site_title }}</td>
                                        <td>{{ $shop->status }}</td>
                                        <td>{{ $shop->upazilla_id }}</td>
                                        <td>
                                            <a href="{{ route('shop.edit', $shop->id) }}" class="btn btn-primary"
                                                style="color:white;">Edit</a>
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


    <!-- Include jQuery if not already included -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}

<script>
    $(document).ready(function() {
        $('#division').on('change', function() {
            var divisionId = $(this).val();
            console.log('Selected Division ID:', divisionId); // Debug line
            if (divisionId) {
                $.ajax({
                    url: '{{ route('get-districts', '') }}/' + divisionId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log('Received Data:', data); // Debug line
                        $('#district').empty();
                        $('#district').append('<option value="">Select District</option>');
                        $.each(data, function(key, value) {
                            $('#district').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX Error:', textStatus); // Debug line
                    }
                });
            } else {
                $('#district').empty();
                $('#district').append('<option value="">Select District</option>');
            }
        });

        $('#district').on('change', function() {
            var districtId = $(this).val();
            console.log('Selected District ID:', districtId); // Debug line
            if (districtId) {
                $.ajax({
                    url: '{{ route('get-thanas', '') }}/' + districtId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log('Received Data:', data); // Debug line
                        $('#Thanas').empty();
                        $('#Thanas').append('<option value="">Select Thana</option>');
                        $.each(data, function(key, value) {
                            $('#Thanas').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX Error:', textStatus); // Debug line
                    }
                });
            } else {
                $('#Thanas').empty();
                $('#Thanas').append('<option value="">Select Thana</option>');
            }
        });
    });
</script>
