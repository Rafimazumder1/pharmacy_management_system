@extends('layouts.app')
@section('title', translate('Returned Medicine'))
@section('content')
    @php
        $i = 0;
        $medicines = json_decode($inv->medicines, true);
        $count = count($medicines);
    @endphp
    <section id="basic-horizontal-layouts">
        <section id="multiple-column-form">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ translate('Returned Medicine') }}</h4>
                        </div>
                        <div class="card-body">
                            <form class="form" method="POST" action="{{route('returned', $inv->id) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                   for="first-name-column">{{ translate('Medicine Name') }}</label>
                                            <select name="medicine" class="form-select">
                                                @foreach($medicines as $medicine)
                                                    @php
                                                        $amount = ($medicine['price']*$medicine['quantity']);
                                                    @endphp
                                                    <option value="{{$medicine['batch_id']}}_{{$medicine['quantity']}}_{{$amount}}">
                                                        {{ $medicine['name'] }} ({{$medicine['quantity']}} PC) - {{\App\Models\Shop::setting('currency')}}{{number_format($amount,2)}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                   for="first-name-column">{{ translate('Quantity') }}</label>
                                            <input type="number" name="qty" required min="1" class="form-control">
                                            @error('qty')
                                            <span class="text-danger">Quantity is required!</span>
                                            @enderror
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
        </section>
    </section>
@endsection