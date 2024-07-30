@extends('layouts.app')
@section('title', __('pages.customer_list'))

@section('custom-css')
    <style>
        .email-sender .list-group .list-group-item input{
            padding: 10px;
        }
        .email-sender .list-group .list-group-item label{
            line-height: 12px;
        }
        .email-sender textarea{
            color: #000;
        }
    </style>
@endsection

@section('content')
    <div class="email-sender">
        <div class="card">
            <div class="card-header bg-transparent">
                <h4 class="card-title">Send Email</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('customer.send_email.process') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <h5>Select Customers:</h5>
                            <ul class="list-group">
                                @foreach($customers as $customer)
                                    <li class="list-group-item d-flex align-items-center">
                                        <input value="{{ $customer->email }}" class="form-check-input me-1" type="checkbox" id="customer{{ $customer->id }}" name="customers[]">
                                        <label  for="customer{{ $customer->id }}">{{ $customer->name }} <small>({{ $customer->email }})</small></label>
                                    </li>
                                @endforeach
                                <span class="text-danger">
                                    @error('customers') {{ $message }} @enderror
                                </span>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-2">
                                <label for="subject">Subject:</label>
                                <input type="text" name="email_subject" class="form-control" id="subject" placeholder="Enter email subject">
                                <p><small class="text-primary">Write your email subject here!</small></p>
                                <span class="text-danger">
                                    @error('email_subject') {{ $message }} @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="body">Body:</label>
                                <textarea name="email_body" class="form-control" id="body" rows="5"
                                          placeholder="Enter email body"></textarea>
                                <p><small class="text-primary">Write your email body here!</small></p>
                                <span class="text-danger">
                                    @error('email_body') {{ $message }} @enderror
                                </span>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mt-2">Send Email</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')

@endsection