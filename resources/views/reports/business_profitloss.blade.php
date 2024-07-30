@extends('layouts.app')
@section('title', 'Business Profit & Loss')
@section('custom-css')
    <style>
        .inner h4{
            color: white;
        }
        .inner p{
            color: white;
        }
    </style>
@endsection
@section('content')
        <section class="app-user-list">
            <div class="card">
                <div class="card-body border-bottom">
                   <h4 class="card-title"> {{ translate('Business Profit & Loss') }}</h4>
                   <div class="row">
                        @php 
                     $setting = Auth::user()->shop;
                    @endphp
                       <div class="col-2">
                           <label for="year">Select Year:</label>
                           <select name="year" id="year" onchange="changeYear(this.value)" class="form-select">
                               @for ($i = date("Y"); $i >= 2000; $i--)
                                   <option value="{{ $i }}" @if(request('year') == $i) selected @endif>{{ $i }}</option>
                               @endfor
                           </select>
                       </div>
                         <div class="col-md-10 user_role">
                            <div class="row">
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-info">
                                        <div class="smalll-box d-flex justify-content-between">
                                            <div class="inner">
                                                <h4>{{$setting->currency ?? 'TK'}} {{ number_format($totalSale,2,".",",")}}</h4>
                                                <p>Total Sales</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-success">
                                        <div class="smalll-box d-flex justify-content-between">
                                            <div class="inner">
                                                <h4>{{$setting->currency ?? 'TK'}} {{ number_format($totalPurchase,2,".",",")}}</h4>
                                                <p>Total Purchase</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-warning">
                                        <div class="smalll-box d-flex justify-content-between">
                                            <div class="inner">
                                                <h4>{{$setting->currency ?? 'TK'}} {{ number_format(abs($totalExpenses),2,".",",")}}</h4>
                                                <p>Total Expense</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <div class="small-box bg-primary ">
                                        <div class="smalll-box d-flex justify-content-between">
                                            <div class="inner">
                                                <h4>{{$setting->currency ?? 'TK'}} {{ number_format(abs($balanceInhand),2,".",",")}}</h4>
                                                <p>Balance In Hand</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>     
                <div class="mx-2 card-datatable table-responsive pt-0">
                    <table class="user-list-table table table-bordered border-dark">
                        <thead class="table-light">
                            <tr>
                                <th>{{ __('pages.Month') }}</th>
                                <th>{{ translate('Total Sales') }}</th>
                                <th>{{ translate('Total Purchases') }}</th>
                                <th>{{ translate('Total Expenses') }}</th>
                                <th>{{ translate('Profit & Loss') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(array_reverse($monthlyData) as $data)
                            <tr>
                                <th>{{$data['month']}}, {{ $year }}</th>
                                <th>{{number_format( $data['total_sales'], 2)}}</th>
                                <th>{{number_format( $data['total_purchases'], 2)}}</th>
                                <th>{{number_format( $data['total_expenses'], 2)}}</th>
                                <th>{{number_format( $data['profit_loss'], 2)}}</th>
                           </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">
                                        <h4 class="py-4">{{ __('pages.No date found') }}!</h4>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
@endsection
@section('custom-js')
    <script>
        function changeYear(year) {
            var nurl = new URL('{{ route('report.businessprofitloss') }}');
            nurl.searchParams.set('year', year);
            location.href = nurl;
        }
    </script>
@endsection
