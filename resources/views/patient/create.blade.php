@php
    $model = 'patient';
    $title = 'Patient Add';
    $breadcrumbs= [
        ['label' => 'Patients', 'link' => route($model.'.index')],
        ['label' => $title],
    ];
@endphp
@extends('layouts.app')
@section('title', translate($title))
@section('content')
    <x-app-container :button="true" route="{{ $model.'.index' }}" buttonTitle="Back" :breadcrumbs="$breadcrumbs" :title="$title">
        <form action="{{ route($model.'.store') }}" method="post" class="row align-content-center">
            @csrf
            <x-form.input
                :required="true"
                name="name"
                label="Name"
                value="{{ @old('name') }}"
                col="col-md-4"
            ></x-form.input>
            <x-form.input
                :required="true"
                name="phone"
                label="Phone"
                value="{{ @old('phone') }}"
                col="col-md-4"
            ></x-form.input>
            <x-form.select
                :required="true"
                name="gender"
                label="Gender"
                value="{{ @old('gender') }}"
                col="col-md-4"
            >
                <option value="male">{{ translate('Male') }}</option>
                <option value="female">{{ translate('Female') }}</option>
                <option value="other">{{ translate('Other') }}</option>
            </x-form.select>
            <x-form.input
                col="col-md-4"
                :required="true"
                type="number"
                name="age"
                label="Age"
            ></x-form.input>
            <x-form.textarea
                name="address"
                label="Address"
            ></x-form.textarea>

            <x-form.button title="Submit" position="start"/>
        </form>
    </x-app-container>
@endsection
