@extends('layouts.app')
@section('title', __('pages.customer_list'))

@section('custom-css')
@endsection

@section('content')
    <div class="sms-sender">
        <div class="card">
            <div class="card-header bg-transparent">
                <h4 class="card-title">Configure your email & SMS Setting.</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.mail_sms_config') }}" method="post">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-lg-6 ">
                            <h4>Email Setting</h4>
                            <div class="form-group mb-2 mt-2">
                                <label class="">MAIL DRIVER</label>
                                <input type="text" name="MAIL_DRIVER" value="{{ $config['MAIL_DRIVER'] }}"
                                    class="form-control">
                            </div>
                            <div class="form-group mb-2 mt-2">
                                <label class="">MAIL HOST</label>
                                <input type="text" name="MAIL HOST" value="{{ $config['MAIL_HOST'] }}"
                                    class="form-control">
                            </div>
                            <div class="form-group mb-2 mt-2">
                                <label class="">MAIL PORT</label>
                                <input type="text" name="MAIL_PORT" value="{{ $config['MAIL_PORT'] }}"
                                    class="form-control">
                            </div>
                            <div class="form-group mb-2 mt-2">
                                <label class="">MAIL USERNAME</label>
                                <input type="text" name="MAIL_USERNAME" value="{{ $config['MAIL_USERNAME'] }}"
                                    class="form-control">
                            </div>
                            <div class="form-group mb-2 mt-2">
                                <label class="">MAIL PASSWORD</label>
                                <input type="text" name="MAIL_PASSWORD" value="{{ $config['MAIL_PASSWORD'] }}"
                                    class="form-control">
                            </div>
                            <div class="form-group mb-2 mt-2">
                                <label class="">MAIL ENCRYPTION</label>
                                <input type="text" name="MAIL_ENCRYPTION" value="{{ $config['MAIL_ENCRYPTION'] }}"
                                    class="form-control">
                            </div>
                            <div class="form-group mb-2 mt-2">
                                <label class="">MAIL FROM ADDRESS</label>
                                <input type="text" name="MAIL_FROM_ADDRESS" value="{{ $config['MAIL_FROM_ADDRESS'] }}"
                                    class="form-control" placeholder="info@companyname.com">
                            </div>
                            <div class="form-group mb-2">
                                <label class="">MAIL FROM NAME</label>
                                <input type="text" name="MAIL_FROM_NAME" value="{{ $config['MAIL_FROM_NAME'] }}"
                                    class="form-control" placeholder="Company name">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary btn-block mt-2">Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')

@endsection
