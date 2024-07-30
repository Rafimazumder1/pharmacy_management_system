@php
        $model = 'prescription';
        $title = 'Prescription Add';
        $breadcrumbs= [
            ['label' => 'Prescriptions', 'link' => route($model.'.index')],
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
                required
                name="visit_no"
                label="Visit No"
                value="{{ @old('visit_no')?? rand(00000,999999) }}"
                col="col-md-4"
            ></x-form.input>
            <x-form.select
                :required="true"
                name="patient_id"
                label="Patient"
                value="{{ @old('patient_id') }}"
                col="col-md-4 mb-0"
            >
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                @endforeach
            </x-form.select>
            <div class="col-lg-4 pt-3">
                <span>{{ translate('If the patient is new then') }} ?</span> <a href="{{ route('patient.create') }}">{{ translate('Add patient') }}</a>
            </div>
            <div class="col-lg-4">
                <h4>Diagnosis Test</h4>
                <div class="" id="diagnosisTest">
                    <div class="row align-items-center diagnosis-test-input" >
                        <x-form.select
                            name="test[]"
                            label="Test"
                            col="col-md-10">
                            @foreach($tests as $test)
                                <option value="{{ $test->name }}-{{ $test->center }}">{{ $test->name }} - {{ $test->center }}</option>
                            @endforeach
                        </x-form.select>
                        <div class="col-lg-2">
                            <button type="button" onclick="addDiagnosisTest()" class="btn btn-sm rounded-3 btn-success"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <h4>Drug / Medicine</h4>
                <div class="" id="drugAndMedicine">
                    <div class="row align-items-center drug-medicine-inputs" >
                        <x-form.select
                            name="medicine[]"
                            label="Medicine"
                            col="col-md-4"
                        >
                            @foreach($medicines as $medicine)
                                <option value="{{ $medicine->name }}-({{ $medicine->generic_name }})">{{ $medicine->name }} - ({{ $medicine->generic_name }})</option>
                            @endforeach
                        </x-form.select>
                        <x-form.select
                            name="schedule[]"
                            label="Schedule"
                            col="col-md-4"
                        >
                            <option selected value="1+1+1">{{ translate('1+1+1') }}</option>
                            <option value="1+1+0">{{ translate('1+1+0') }}</option>
                            <option value="1+0+0">{{ translate('1+0+0') }}</option>
                            <option value="0+1+1">{{ translate('0+1+1') }}</option>
                            <option value="0+0+1">{{ translate('0+0+1') }}</option>
                            <option value="0+1+0">{{ translate('0+1+0') }}</option>
                        </x-form.select>
                        <x-form.input
                            label="Day"
                            col="col-md-2"
                            type="number"
                            name="day[]"
                            placeholder="Day"
                            value="1"
                        ></x-form.input>
                        <div class="col-lg-2">
                            <button type="button" onclick="addMoreMedicine()" class="btn btn-sm rounded-3 btn-success"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <x-form.select
                required
                name="referred_to"
                label="Referred To"
                value="{{ @old('referred_to') }}"
                col="col-md-4"
            >
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </x-form.select>
            <x-form.input
                required
                name="visit_fees"
                label="Visiting Fee"
                value="{{ @old('visit_fees') }}"
                col="col-md-4"
            ></x-form.input>
            <div></div>
            <x-form.textarea
                col="col-lg-6"
                name="description"
                label="Patients Problems / Symptoms description"
                value="{{ @old('description') }}"
            ></x-form.textarea>
            <x-form.textarea
                col="col-lg-6"
                name="advice"
                label="Advice"
                value="{{ @old('advice') }}"
            ></x-form.textarea>

            <x-form.button title="Submit" position="start"/>
        </form>
    </x-app-container>
@endsection
@section('custom-js')
    <script>
        const addMoreMedicine = () => {
            $('#drugAndMedicine').append(`
            <div class="row align-items-center drug-medicine-inputs" >
                        <x-form.select
                            name="medicine[]"
                            col="col-md-4"
                        >
                            @foreach($medicines as $medicine)
            <option value="{{ $medicine->name }}-({{ $medicine->generic_name }}) ">{{ $medicine->name }} {{ $medicine->generic_name }}</option>
                            @endforeach
            </x-form.select>
            <x-form.select
                name="schedule[]"
                            col="col-md-4"
                        >
                            <option selected value="1+1+1">{{ translate('1+1+1') }}</option>
                            <option value="1+1+0">{{ translate('1+1+0') }}</option>
                            <option value="1+0+0">{{ translate('1+0+0') }}</option>
                            <option value="0+1+1">{{ translate('0+1+1') }}</option>
                            <option value="0+0+1">{{ translate('0+0+1') }}</option>
                            <option value="0+1+0">{{ translate('0+1+0') }}</option>
                        </x-form.select>

                        <x-form.input
                            col="col-md-2"
                            type="number"
                            name="day[]"
                            placeholder="Day"
                            value="1"
                        ></x-form.input>
                        <div class="col-lg-2">
                        <button type="button" onclick="removeMoreMedicine(this)" class="btn btn-sm rounded-3 btn-danger"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
            `)
        }

        const addDiagnosisTest = () =>{
            $('#diagnosisTest').append(`
            <div class="row align-items-center diagnosis-test-input" >
                        <x-form.select
                            name="test[]"
                            col="col-md-10"
                        >
                            @foreach($tests as $test)
                                <option value="{{ $test->name }}-{{ $test->center }}">{{ $test->name }} - {{ $test->center }}</option>
                            @endforeach
            </x-form.select>
            <div class="col-lg-2">
                <button type="button" onclick="removeDiagnosisTest(this)" class="btn btn-sm rounded-3 btn-danger"><i class="fa fa-times"></i></button>
            </div>
        </div>
`)
        }

        const removeMoreMedicine = (obj) => {
            $(obj).closest('.drug-medicine-inputs').remove();
        }
        const removeDiagnosisTest = (obj) => {
            $(obj).closest('.diagnosis-test-input').remove();
        }
    </script>
@endsection
