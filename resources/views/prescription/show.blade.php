@php
    $model = 'prescription';
    $title = 'Prescription';
    $breadcrumbs= [
        ['label' => 'Prescription'],
        ['label' => 'Prescription Show'],
    ];
@endphp
@extends('layouts.app')
@section('title', translate($title))
@section('custom-css')
    <style>
        @media print {
            body {
                margin-left: auto;
                margin-right: auto;
            }
            .main-menu.menu-fixed {
                display: none
            }
            nav.header-navbar {
                display: none
            }
            .fa.fa-chevron-up {
                display: none
            }

            .content-wrapper .row.mb-0.mb-1.align-content-center {
                display: none
            }
            html .content.app-content{
                padding: 0px !important;
            }
            html .content{
                margin: 0px !important;
            }
            .card{
                box-shadow: none !important;
                background-color: transparent;
                border: none !important;
            }

            #print-button {
                display: none
            }
        }

        .devided-border {
            width: 98%;
            margin: 0 auto;
            border-bottom: 3px solid #3F51B5;
            padding-top: 2px;
        }

        .underline_border {
            border-bottom: 1px dashed #444;
            width: 100%;
            text-transform: capitalize;
            padding: 0 34px;
            white-space: nowrap;
        }

        .medicines-test h1.rx-logo {
            font-size: 55px;
            font-family: emoji;
            font-weight: 600;
            padding: 0px 20px;
        }
        .medicines-test .box {
            margin-left: 140px;
        }

        h1.rx-logo small {
            font-size: 35px;
        }

    </style>
@endsection
@section('content')
    <x-app-container :breadcrumbs="$breadcrumbs" :title="$title" :button="true" route="{{ $model.'.index' }}" buttonTitle="Back">
        <div class="text-end" id="print-button">
            <a href="javascript:" onclick="printContent()" class="btn btn-success">
               <i class="fa fa-print"></i> {{ translate('Print') }}
            </a>
        </div>
        <table class="table">
            <tr>
                <th class="text-center">
                    <h1 class="text-primary text-uppercase fw-bold display-6">BPDB PHarmacy</h1>
                </th>
            </tr>
        </table>
        <table class="table table-borderless">
            <tr>
                <th>
                    <h3>{{ @$prescription->doctor->name }}  </h3>
                    <span class="">{{ @$prescription->doctor->title }}</span>
                </th>
            </tr>
            <tr>
                <td>
                    {{ @$prescription->doctor->address }}
                </td>
                <td>
                    {{ @$prescription->doctor->phone }}
                </td>
            </tr>
        </table>
        <div class="devided-border"></div>

        <table class="table-borderless table my-2">
            <tr>
                <td><b>{{ translate('Patient Name') }}</b>: <span class="underline_border">{{ @$prescription->patient->name }}</span></td>
                <td><b>{{ translate('Age') }}</b>: <span class="underline_border">{{ @$prescription->patient->age }}</span></td>
                <td><b>{{ translate('Gender') }}</b>: <span class="underline_border">{{ @$prescription->patient->gender }}</span></td>
            </tr>
            <tr>
                <td colspan="2"><b>{{ translate('Address') }}</b>: <span
                        class="underline_border">{{ @$prescription->patient->address }}</span></td>
                <td>
                    <b>{{ translate('Date') }}</b>: <span class="underline_border">
                        {{ date('F d, Y', strtotime($prescription->date)) }}</span>
                </td>
            </tr>
        </table>
        <div class="medicines-test">
            <table class="table table-borderless">
                <tr>
                    <td width="10%">
                        <h1 class="rx-logo text-primary"><i class="fas fa-prescription"></i></h1>
                    </td>
                    <td width="20%">
                      <b>{{ translate('Problems / Symptoms') }}</b>:
                    </td>
                    <td>
                        {{ $prescription->description }}
                    </td>
                </tr>
            </table>
            <div class="box">
                <div class="medicines">
                    <strong class="text-dark">{{ translate('Medicines') }}:</strong>
                    <table class="table table-borderless">
                        @forelse(json_decode($prescription->medicines) ?? [] as $medicine)
                            <tr>
                                <td>{{ $loop->iteration }} /</td>
                                <td>{{ @$medicine->medicine }}</td>
                                <td>{{ @$medicine->schedule }}</td>
                                <td>{{ @$medicine->day }} Days</td>
                            </tr>
                        @empty
                        @endforelse
                    </table>
                </div>
                <div class="tests">
                    <strong class="text-dark">{{ translate('Diagnosis Test') }}</strong>
                    <table class="table table-borderless">
                        @forelse(json_decode($prescription->tests) ?? [] as $test)
                            <tr>
                                <td>{{ $loop->iteration }} /</td>
                                <td>{{ @$test->test }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </table>
                </div>
                <br>
                <table class="table table-borderless border">
                    <tr>
                        <th width="12%">{{ translate('Advice') }}:</th>
                        <td width="88%">{{ $prescription->advice }}</td>
                    </tr>
                </table>
                <br>
            </div>
        </div>
        <div class="devided-border"></div>
        <table class="table-borderless table">
            <tr>
                <td class="py-2"><span>{{ translate('Prescribed By') }}:</span> <b>{{ @$prescription->doctor->name }}</b></td>
            </tr>
        </table>
        <table class="table border-bottom">
            <tr>
                <td><b>{{ translate('Phone') }}:</b> 01730000000 </td>
                {{--{{ setting('store_phone') }}{{ setting('app_name') }} {{ setting('store_address') }} --}}
                <td class="text-end"><b>{{ translate('Address') }}: </b></td>
            </tr>
        </table>

    </x-app-container>
@endsection

@section('custom-js')
    <script type="text/javascript">
        const printContent = () => {
            window.print();
        }
    </script>
@endsection
