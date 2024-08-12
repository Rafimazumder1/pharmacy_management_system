@extends('layouts.app')
@section('title', 'Ecommerce Settings')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                    <h4 class="card-title mb-0">{{ __('pages.Export & Import') }}</h4>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="card border-warning">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 border-right">
                                        <h4>{{ __('pages.Product CSV Uploder') }}</h4>
                                        <form action="{{ route('medicines.import.process') }}" id="contentForm" enctype="multipart/form-data"
                                              method="post">
                                            @csrf
                                            <div class="mt-2">
                                                <input type="file" name="medicines" accept="text/csv">
                                                <button type="submit" class="btn btn-success mt-2 w-100">
                                                    <i class="fas fa-cloud-upload"></i>{{ __('pages.Upload Now') }}
                                                </button>
                                                @error('medicines')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-8">
                                        <h6>{{ __('pages.Important Notes:') }}</h6>
                                        <ol>
                                            <li>{{__('pages.Click here to')}} <code><a download="medicines"
                                                                                       href="{{ asset('medicine_sample.csv') }}"><i
                                                                class="fas fa-download"></i> {{ __('pages.Download Sample') }}
                                                        {{ __('pages.CSV') }}</a></code></li>
                                            <li>{{ __('pages.The sample') }} <code>{{__('pages.CSV')}}</code> {{ __('pages.file will download to your computer') }}.</li>
                                            <li>
                                                {{ __('pages.Open the downloaded') }} <code>{{__('pages.CSV')}}</code>{{__('pages.file in a spreadsheet program (such as Microsoft Excel or Google Sheets) to view its format')}} .
                                            </li>
                                            <li>{{ __('pages.Upload or list your product data and upload the file') }}.</li>
                                            <li>{{ __('pages.The uploaded file extension must be') }}<code>.{{__('pages.csv')}}</code></li>
                                            <p class="mt-1"><b>{{ __('pages.Notes') }}: </b>{{ __('Before uploading your medicine list you need
                                                to know Supplier’s id, vendor’s id, Unit’s id, leaf’s id to put into
                                                main CSV file to upload perfectly. Please click bellow and download
                                                following CSV files to know your existing ids') }} </p>

                                            <li>{{ __('Click here to') }} <code><a
                                                            href="{{ route('medicines.csv.exporter','categories') }}"><i
                                                                class="fas fa-download"></i> {{__('pages.Download Categories CSV')}} </a></code>
                                            </li>
                                            <li>{{ __('Click here to') }} <code>
                                                    <a href="{{ route('medicines.csv.exporter','suppliers') }}">
                                                        <i class="fas fa-download"></i> {{__('pages.Download Suppliers CSV')}}</a>
                                                </code>
                                            </li>
                                            <li>{{ __('Click here to') }} <code>
                                                    <a href="{{ route('medicines.csv.exporter','vendors') }}">
                                                        <i class="fas fa-download"></i> {{__('pages.Download Vendors CSV')}}
                                                    </a>
                                                </code>
                                            </li>
                                            <li>{{ __('Click here to') }} <code><a
                                                            href="{{ route('medicines.csv.exporter','units') }}"><i
                                                                class="fas fa-download"></i> {{__('pages.Download Units CSV')}}</a></code></li>
                                            <li>{{ __('Click here to') }} <code>
                                                    <a  href="{{ route('medicines.csv.exporter','leaves') }}"><i
                                                                class="fas fa-download"></i>{{__('pages.Download Leaf CSV')}} </a></code>
                                            </li>
                                            <li>{{ __('Click here to') }} <code>
                                                    <a  href="{{ route('medicines.csv.exporter','types') }}"><i
                                                                class="fas fa-download"></i>{{__('pages.Download Types CSV')}} </a></code>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-js')
@endsection