@php
    $model = 'doctor';
    $title = 'Doctor Edit';
    $breadcrumbs= [
        ['label' => 'Doctors', 'link' => route($model.'.index')],
        ['label' => $title],
    ];
@endphp
@extends('layouts.app')
@section('title', translate($title))
@section('content')
    <x-app-container :button="true" route="{{ $model.'.index' }}" buttonTitle="Back" :breadcrumbs="$breadcrumbs" :title="$title">
        <form action="{{ route($model.'.update',$doctor->id)}}" method="post" class="row align-content-center">
            @csrf
            @method('put')
            <x-form.input
                :required="true"
                name="name"
                label="Name"
                value="{{ $doctor->name }}"
                col="col-md-4"
            ></x-form.input>
            <x-form.input
                :required="true"
                name="title"
                label="Title"
                value="{{ $doctor->title }}"
                col="col-md-4"
            ></x-form.input>
            <x-form.input
                :required="true"
                name="phone"
                label="Phone"
                value="{{ $doctor->phone }}"
                col="col-md-4"
            ></x-form.input>
            <x-form.input
                name="address"
                label="Address"
                value="{{ $doctor->address }}"
                col="col-md-4"
            ></x-form.input>
            <x-form.input
                name="hospital"
                label="Hospital"
                value="{{ $doctor->hospital }}"
                col="col-md-4"
            ></x-form.input>
            <x-form.textarea
                :required="true"
                name="speciality"
                label="Speciality"
                value="{{ $doctor->speciality }}"
            ></x-form.textarea>

            <x-form.button title="Submit" position="start"/>
        </form>
    </x-app-container>
@endsection
@push('scripts')
@endpush
