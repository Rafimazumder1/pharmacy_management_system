@extends('layouts.app')
@section('title', __('pages.invoice'))
@section('custom-css')
    <style>
        body {
            color: #303030;
        }

        .tb-dotted {
            display: block;
            border-top: 1px dotted black;
            margin: 5px 0px;
        }

        .invoice_id {
            margin: 9px 0;
        }

        .card {
            background-color: #fff !important;
        }
    </style>
@endsection
@section('content')
    <section class="app-user-view-account">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                <div class="text-end mb-1">
                    <button onclick="printDiv('printableArea')" class="btn btn-success">Print</button>
                </div>
                <div class="card">
                    <div id="printableArea">
                        <div id="invoice" class="row">
                            <div class="col-xs-12 col-md-12">
                                <section style="width: 70%; margin: 10px auto;background-color: #fff; padding:5px"
                                         id="invoiceArea">
                                    <header style="text-align: center; padding-bottom: 0px">

                                        <h2 style="font-size: 24px; font-weight: 700; margin: 0; padding: 0;">{{Auth::user()->shop->name}}</h2>
                                        <div style="margin-bottom: 5px; line-height: 1;">
                                            <span style="font-size: 15px ;line-height: 30px;">{{Auth::user()->shop->address}}</span>
                                            <div style="display: block;">
                                                <span style="font-size: 15px ;line-height: 30px;">Mobile: {{Auth::user()->shop->phone}}</span>,
                                                <span
                                                        style="font-size: 15px ;line-height: 30px;">Email: {{Auth::user()->shop->email}}</span>
                                            </div>
                                        </div>
                                    </header>
                                    <span class="tb-dotted"></span>
                                    <section style="font-size: 15px ;line-height: 30px;  line-height: 1.222;">
                                        <table style="width: 100%;">
                                            <tr style=" ">
                                                <td class="w-30" style="font-size: 15px ;line-height: 30px"><span
                                                            style="font-size: 15px ;line-height: 30px"><b>Date:</b></td>
                                                <td style="font-size: 15px ;line-height: 30px;text-align:right ;font-weight:500">{{date('d M, Y', strtotime($invoice->date))}}</td>
                                            </tr>
                                            <tr style=" ">
                                                <td class="w-30" style="font-size: 15px ;line-height: 30px"><span
                                                            style="font-size: 15px ;line-height: 30px"><b>Invoice ID:</b>
                                                </td>
                                                <td style="font-size: 15px ;line-height: 30px;text-align:right">{{$invoice->inv_id}}</td>
                                            </tr>
                                            @if($invoice->customer_id != 0)
                                                <tr style=" ">
                                                    <td class="w-30" style="font-size: 15px ;line-height: 30px"><b>Customer
                                                            Name:</b></td>
                                                    <td style="font-size: 15px ;line-height: 30px;text-align:right">{{$invoice->customer->name}}</td>
                                                </tr>
                                                <tr style=" ">
                                                    <td class="w-30" style="font-size: 15px ;line-height: 30px"><b>Phone:</b>
                                                    </td>
                                                    <td style="font-size: 15px ;line-height: 30px;text-align:right">{{$invoice->customer->phone}}</td>
                                                </tr>
                                                <tr style=" ">
                                                    <td class="w-30" style="font-size: 15px ;line-height: 30px"><b>Address:</b>
                                                    </td>
                                                    <td style="font-size: 15px ;line-height: 30px;text-align:right">{{$invoice->customer->address}}</td>
                                                </tr>
                                            @else

                                                <tr style=" ">
                                                    <td class="w-30" style="font-size: 15px ;line-height: 30px"><b>Customer
                                                            Name:</b></td>
                                                    <td style="font-size: 15px ;line-height: 30px;text-align:right">
                                                        Walking Customer
                                                    </td>
                                                </tr>

                                            @endif
                                        </table>
                                    </section>

                                    <h4 style="font-size: 18px;
                    font-weight: 700;
                    text-align: center;
                    margin: 50px 0px 20px 0px;
                    padding: 0px 0;">INVOICE</h4>
                                    <span class="tb-dotted"></span>
                                    @php
                                        $total_vat_amount = 0;
                                            $total = 0;
                                            $paid = \App\Models\InvoicePay::where('invoice_id', $invoice->id)->sum('amount');
                                            $medicine = json_decode($invoice['medicines'], true);
                                            $count = count($medicine);
                                    @endphp
                                    <section style="line-height: 1.23;">
                                        <table style="width: 100%">
                                            <thead>
                                            <tr style="  font-weight: 700;">
                                                <th class="w-40" style="font-size: 15px ;line-height: 30px;">Medicine
                                                </th>
                                                <th class="w-15 text-center"
                                                    style="font-size: 15px ;line-height: 30px; text-align: center">Qty
                                                </th>
                                                <th class="w-15 text-right"
                                                    style="font-size: 15px ;line-height: 30px; text-align: center">Price
                                                </th>
                                                <th class="w-20 text-right"
                                                    style="border-bottom: none; font-size: 15px ;line-height: 30px; text-align: right">
                                                    Total
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $total_sale_amount = 0;
                                            @endphp
                                            @foreach($medicine as $i => $med)
                                                @php
                                                    $total_vat_amount += $med['vat'];
                                                    $amount = ($med['price']*$med['quantity']);
                                                    $total += $amount;
                                                    $batch = \App\Models\Batch::find($med['batch_id']);
                                                    $total_sale_amount+=($amount+$total_vat_amount);
                                                @endphp
                                                <tr style="">
                                                    <td style="vertical-align: top; font-size: 15px ;line-height: 30px">
                                                        {{ Str::limit($med['name'], 150)  }}
                                                    </td>
                                                    <td
                                                        style="vertical-align: top; font-size: 15px ;line-height: 30px; text-align: center">{{$med['quantity']}} </td>
                                                    <td style="vertical-align: top; font-size: 15px ;line-height: 30px; text-align: center">{{number_format($batch['price'], 2)}}</td>
                                                    <td style="border-bottom: none;vertical-align: top;font-size: 15px ;line-height: 30px;text-align: right ">{{ number_format($amount,2) }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <section style="line-height: 1.23; font-size: 15px ;line-height: 30px; border-top: 1px dotted #000;">
                                            <table style="width: 100%">
                                                <tr style="">
                                                    <td style="text-align: right; font-size: 15px ;line-height: 30px; width: 70%">
                                                        Sub Total:
                                                    </td>
                                                    <td style="text-align: right; font-size: 15px ;line-height: 30px; width: 70%">
                                                        {{number_format($total,2)}}
                                                    </td>
                                                </tr>
                                                <tr style="  ">
                                                    <td style="text-align: right; font-size: 15px ;line-height: 30px; width: 70%">
                                                        Discount:
                                                    </td>
                                                    <td style="text-align: right; font-size: 15px ;line-height: 30px; width: 70%">
                                                        {{number_format($invoice->discount,2)}}
                                                    </td>
                                                </tr>
                                                <tr style="">
                                                    <td style="text-align: right; font-size: 15px ;line-height: 30px; width: 70%">
                                                        Vat:
                                                    </td>
                                                    <td style="text-align: right; font-size: 15px ;line-height: 30px; width: 70%">
                                                        {{number_format($total_vat_amount,2)}}
                                                    </td>
                                                </tr>
                                                <tr style="  ">
                                                    <td style="text-align: right; font-size: 15px ;line-height: 30px; width: 70%">
                                                        Due:
                                                    </td>
                                                    <td style="text-align: right; font-size: 15px ;line-height: 30px; width: 70%">
                                                        {{number_format($invoice->due_price,2)}}
                                                    </td>
                                                </tr>
                                                    @php $grand_total = $total+$total_vat_amount - $invoice->discount; @endphp
                                                <tr style="  ">
                                                    <td style="text-align: right; font-size: 15px ;line-height: 30px; width: 70%">
                                                        Total Amount:
                                                    </td>
                                                    <td style="text-align: right; font-size: 15px ;line-height: 30px; width: 70%">
                                                        {{number_format($grand_total,2)}}
                                                    </td>
                                                </tr>
                                            </table>
                                        </section>
                                        <h4 class="text-uppercase" style="font-size: 18px;
                    font-weight: 700;
                    text-align: center;
                    margin: 20px 0px 20px 0px;
                    padding: 0px 0;">{{ translate('Return Medicine') }}</h4>
                                        <span class="tb-dotted"></span>
                                        <table class="table">
                                            <tr class="mt-1">
                                                <th>{{ translate('Medicine') }}</th>
                                                <th>{{ translate('Qty') }}</th>
                                                <th>{{ translate('Price') }}</th>
                                                <th>{{ translate('Amount') }}</th>
                                            </tr>
                                        @if($returns->batch_id)
                                            @php
                                                $batch = \App\Models\Batch::find($returns->batch_id);
                                                $medicine  = \App\Models\Medicine::find($batch->medicine_id);
                                            @endphp
                                            <tr>
                                                <td>
                                                    {{ $medicine->name }}
                                                </td>
                                                <td>{{ $returns->quantity }}</td>
                                                <td>{{ number_format($returns->amount / $returns->quantity,2)}}</td>
                                                <td>{{ number_format($returns->amount,2)  }}</td>
                                            </tr>
                                            @else
                                             <tr>
                                                 <td colspan="4" class="text-center"><h4>No Medicine Found!</h4></td>
                                             </tr>
                                            @endif
                                        </table>
                                    </section>
                                    <section
                                            style="font-size: 15px ;line-height: 30px; text-align: center; padding-top:55px">
                                        <span class="tb-dotted"></span>
                                        <span style="display: block; font-weight: 700;">Thank you for choosing us!</span>
                                        <span style="display: block;">Software Developed By Ayaantech Limited. www.ayaantec.com</span>
                                    </section>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
                location.reload();
            }
        </script>
    </section>
@endsection

@section('custom-js')


    <!-- BEGIN: Page Vendor JS-->


    <script src="{{ asset('dashboard/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>

    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/js/scripts/pages/app-invoice.min.js') }}"></script>
    <!-- END: Page Vendor JS-->
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            // location.reload();
        }
    </script>
    <script>
        $(function () {

            var table = $('.datatable-project').DataTable({
                processing: true,
                serverSide: false,

            });

        });
    </script>
@endsection