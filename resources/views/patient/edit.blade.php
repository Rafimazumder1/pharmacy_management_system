@php
    $model = 'patient';
    $title = 'Patient Edit';
    $breadcrumbs= [
        ['label' => 'Patients', 'link' => route($model.'.index')],
        ['label' => $title],
    ];
@endphp
@extends('layouts.app')
@section('title', translate($title))
@section('content')
    <x-app-container :button="true" route="{{ $model.'.index' }}" buttonTitle="Back" :breadcrumbs="$breadcrumbs" :title="$title">
        <form action="{{ route($model.'.update',$patient->id)}}" method="post" class="row align-content-center">
            @csrf
            @method('put')
            <x-form.input
                :required="true"
                name="name"
                label="Name"
                value="{{ $patient->name }}"
                col="col-md-4"
            ></x-form.input>
            <x-form.input
                :required="true"
                name="phone"
                label="Phone"
                value="{{ $patient->name }}"
                col="col-md-4"
            ></x-form.input>
            <x-form.select
                :required="true"
                name="gender"
                label="Gender"
                value="{{ $patient->name }}"
                col="col-md-4"
            >
                <option {{ $patient->gender == 'male' ? 'selected':'' }} value="male">{{ translate('Male') }}</option>
                <option {{ $patient->gender == 'female' ? 'selected':'' }} value="female">{{ translate('Female') }}</option>
                <option {{ $patient->gender == 'other' ? 'selected':'' }} value="other">{{ translate('Other') }}</option>
            </x-form.select>
            <x-form.input
                col="col-md-4"
                :required="true"
                type="number"
                name="age"
                label="Age"
                value="{{ $patient->age }}"
            ></x-form.input>
            <x-form.textarea
                name="address"
                label="Address"
                value="{{ $patient->address }}"
            ></x-form.textarea>

            <x-form.button title="Submit" position="start"/>
        </form>
    </x-app-container>
@endsection
@push('scripts')
@endpush
