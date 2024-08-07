@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('shop.update', $shop->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" name="id" id="id" class="form-control" value="{{ $shop->id }}"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @if ($shop->image)
                            <img src="{{ asset('storage/images/shops/' . $shop->image) }}" alt="shop image" height="50">
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $shop->name }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ $shop->phone }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="site_logo">Site Logo</label>
                        <input type="file" name="site_logo" id="site_logo" class="form-control">
                        @if ($shop->site_logo)
                            <img src="{{ asset('storage/images/shops/' . $shop->site_logo) }}" alt="site logo"
                                height="50">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="site_title">Site Title</label>
                        <input type="text" name="site_title" id="site_title" class="form-control"
                            value="{{ $shop->site_title }}">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" name="status" id="status" class="form-control"
                            value="{{ $shop->status }}">
                    </div>


                    <button type="submit" class="btn btn-primary">Update Shop</button>
                </form>
            </div>
        </div>
    </div>
@endsection
