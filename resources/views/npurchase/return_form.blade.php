@extends('layouts.app')
@section('title', __('Return History'))
@section('custom-css')
    <style>
        .table > :not(caption) > * > * {
            padding: 4px 6px !important;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                    <h4 class="card-title mb-0">{{ translate('Returned Medicine') }}</h4>
                    <a href="{{ route('purchase.index') }}" class="btn btn-primary">{{ __('pages.Back') }}</a>
                </div>
                <div class="card-body">
                    <form class="form" method="POST" action="{{route('purchase.return.process', $inv->id) }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label"
                                           for="first-name-column">{{ translate('Medicine Name') }}</label>

                                    <select name="medicine" class="form-select" required>
                                        @foreach($medicine as $batch)
                                            <option value="{{$batch->medicine_id}}">{{ $batch->medicine->name}}
                                                ({{$batch->qty}} PC) - {{\App\Models\Shop::setting('currency')}}{{$batch->buy_price*$batch->qty}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">@error('medicine') {{ $message }} @enderror</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label"
                                           for="first-name-column">{{ translate('Quantity') }}</label>
                                    <input type="number" name="qty" class="form-control">
                                    <span class="text-danger">@error('qty') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit"
                                        class="btn btn-primary me-1 waves-effect waves-float waves-light">{{ __('pages.submit') }}</button>
                                <button type="reset"
                                        class="btn btn-outline-secondary waves-effect">{{ __('pages.reset') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')

@endsection