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
                                <td><img src="{{ asset('storage/images/shops/' . $shop->image) }}" alt="Image" width="50"></td>
                                <td>{{ $shop->name }}</td>
                                <td>{{ $shop->next_pay }}</td>
                                <td>{{ $shop->phone }}</td>
                                <td><img src="{{ asset('storage/images/shops/' . $shop->site_logo) }}" alt="Site Logo" width="50"></td>
                                <td>{{ $shop->site_title }}</td>
                                <td>{{ $shop->status }}</td>
                                <td>{{ $shop->upazilla_id }}</td>
                                <td>{{ $shop->username }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <a href="{{ route('shop.edit', $shop->id) }}" class="btn btn-primary">
                                        Edit
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('shop.delete', $shop->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this shop?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
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
