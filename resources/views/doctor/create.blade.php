@php
        $model = 'doctor';
        $title = 'Doctor Add';
        $breadcrumbs= [
            ['label' => 'Doctors', 'link' => route($model.'.index')],
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
                name="title"
                label="Title"
                value="{{ @old('title') }}"
                col="col-md-4"
            ></x-form.input>
            <x-form.input
                :required="true"
                name="phone"
                label="Phone"
                value="{{ @old('phone') }}"
                col="col-md-4"
            ></x-form.input>
            <x-form.input
                name="address"
                label="Address"
                value="{{ @old('address') }}"
                col="col-md-4"
            ></x-form.input>
            <x-form.input
                name="hospital"
                label="Hospital"
                value="{{ @old('hospital') }}"
                col="col-md-4"
            ></x-form.input>
            <x-form.textarea
                :required="true"
                name="speciality"
                Label="Speciality"
                placeholder="speciality"
            ></x-form.textarea>

            <x-form.button title="Submit" position="start"/>
        </form>
    </x-app-container>
@endsection
@push('scripts')
@endpush
