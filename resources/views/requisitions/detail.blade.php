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

                        <form action="{{ route('requisitions.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Add select input field for medicine -->
                            <div class="mb-3">
                                <label for="medicine" class="form-label">Medicine</label>
                                <select class="form-control" id="medicine" name="medicine_id" required>
                                    <option value="">Select Medicine</option>
                                    @foreach ($medicines as $medicine)
                                        <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- <div class="form-group">
                                <label for="shop_id">Shop</label>
                                <select name="SHOP_ID" id="SHOP_ID" class="form-control">
                                    @foreach ($shops as $shop)
                                        <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}

                            <!-- Input field for the requisition quantity -->
                            <div class="mb-3">
                                <label for="qty" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="qty" name="qty" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Requisition</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>