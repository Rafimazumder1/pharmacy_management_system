@php
    $model = 'test';
    $title = 'Diagnosis & Tests Edit';
    $breadcrumbs= [
        ['label' => 'Diagnosis & Tests', 'link' => route($model.'.index')],
        ['label' => $title],
    ];
@endphp
@extends('layouts.app')
@section('title', translate($title))
@section('content')
    <x-app-container :button="true" route="{{ $model.'.index' }}" buttonTitle="Back" :breadcrumbs="$breadcrumbs" :title="$title">
        <form action="{{ route($model.'.update',$test->id)}}" method="post" class="row align-content-center">
            @csrf
            @method('put')
            <x-form.input
                :required="true"
                name="name"
                label="Name"
                value="{{ $test->name }}"
                col="col-md-4"
            ></x-form.input>
            <x-form.input
                name="center"
                label="Center"
                value="{{ $test->center }}"
                col="col-md-4"
            ></x-form.input>

            <x-form.button title="Submit" position="start"/>
        </form>
    </x-app-container>
@endsection
@push('scripts')
@endpush
