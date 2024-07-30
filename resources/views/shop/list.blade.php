@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table id="shopsTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Next Pay</th>
                            <th>Phone</th>
                            <th>Site Logo</th>
                            <th>Site Title</th>
                            <th>Status</th>
                            <th>Upazilla ID</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shops as $shop)
                            <tr>
                                <td>{{ $shop->id }}</td>
                                <td>{{ $shop->image }}</td>
                                <td>{{ $shop->name }}</td>
                                <td>{{ $shop->next_pay }}</td>
                                <td>{{ $shop->phone }}</td>
                                <td>{{ $shop->site_logo }}</td>
                                <td>{{ $shop->site_title }}</td>
                                <td>{{ $shop->status }}</td>
                                <td>{{ $shop->upazilla_id }}</td>
                                <td>{{ $shop->username }}</td>
                                <td>
                                    <button class="btn btn-primary">
                                        <a href="{{ route('shop.edit', $shop->id) }}"
                                            style="text-decoration: none; color:white;">Edit</a>
                                    </button>
                                    <button class="btn btn-danger">
                                        <a onclick="return confirm('Are you sure?')"
                                            href="{{ route('shop.delete', $shop->id) }}"
                                            style="text-decoration: none; color:white;">Delete</a>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#shopsTable').DataTable();
        });
    </script>
@endsection
