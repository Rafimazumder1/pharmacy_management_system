@extends('layouts.app')
@section('title', 'Admin')
@section('content')
    <section class="index">
        <div class="card border-0">
            <div class="card-header bg-transparent">
                <div class="">
                    <h3 class="card-title">{{ translate('Admin') }}</h3>
                    <p><a href="{{ url('dashboard') }}">Dashboard</a> / Admin</p>
                </div>
                <a class="btn btn-primary" href="{{ route('admin.create') }}"><i class="fa fa-plus"></i> Add New</a>
            </div>
            <div class="card-body">
                <div class="card-datatable table-responsive pt-0">
                    <table class="user-list-table table table-bordered border-dark">
                        <thead class="table-light">
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Shop Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ !empty($admin->role) ? $admin->role->name : 'N/L' }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ !empty($admin->shop) ? $admin->shop->name : 'N/L' }}</td>
                                    <td class="d-flex">
                                        <button class="btn btn-primary"><a style="text-decoration: none; color:white;"
                                                href="{{ route('admin.edit', $admin->id) }}">
                                                <i class="fa fa-edit"></i>Edit
                                            </a></button>
                                        <form onclick="return confirm(\'Are you sure?\')"
                                            action="{{ route('admin.destroy', $admin->id) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="fas fa-trash"></i>Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
@endsection
