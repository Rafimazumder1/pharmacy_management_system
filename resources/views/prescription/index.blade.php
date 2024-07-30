@php
    $model = 'prescription';
    $title = 'Prescription';
    $breadcrumbs= [
        ['label' => 'Prescription'],
        ['label' => 'Prescription List'],
    ];
    $headers = [
        ['text' => 'Prescription No', 'value' => 'prescription_no','searchable' => true],
        ['text' => 'Patient', 'value' => (fn($item) => @$item->patient->name)],
        ['text' => 'Visit No', 'value' => 'visit_no','searchable' => true],
        ['text' => 'Visit Fees', 'value' => 'visit_fees'],
        ['text' => 'Date', 'value' => 'created_at'],
    ];
    $actions = [
        ['permission' => "$model.show",'link' => (fn($item) => route("$model.show", $item['id'])), 'icon' => 'fas fa-eye', 'class' => 'btn-outline-info',],
        ['permission' => "$model.destroy",'link' => (fn($item) => route("$model.destroy", $item['id'])), 'icon' => 'fas fa-trash', 'class' => 'btn-outline-danger', 'method' => 'delete']
    ];
@endphp
@extends('layouts.app')
@section('title', translate($title))
@section('content')
    <x-app-container
        :breadcrumbs="$breadcrumbs"
        :title="$title"
        :button="true"
        route="{{ $model.'.create' }}"
        buttonTitle="Add New"
    >
        <x-basetable
            :headers="$headers"
            :collection="$collection"
            :actions="$actions"
        ></x-basetable>
    </x-app-container>
@endsection
