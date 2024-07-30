@php
    $model = 'test';
    $title = 'Diagnosis & Tests';
    $breadcrumbs= [
        ['label' => 'Prescription'],
        ['label' => 'Diagnosis & Tests'],
    ];
    $headers = [
        ['text' => 'Name', 'value' => 'name','searchable' => true],
        ['text' => 'Center', 'value' => 'center','searchable' => true],
        ['text' => 'Created At', 'value' => 'created_at'],
    ];
    $actions = [
        ['permission' => "$model.edit",'link' => (fn($item) => route("$model.edit", $item['id'])), 'icon' => 'fas fa-pencil', 'class' => 'btn-outline-primary',],
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
