@extends('layouts.app')
@section('title', 'Purchase List')
@section('custom-css')
    <style>
        .table > :not(caption) > * > * {
            padding: 4px 6px !important;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                    <h4 class="card-title mb-0">{{ translate('Invoice History') }}</h4>
                </div>
                <div class="card-body">
                    <div class="row justify-content-between mb-1">
                        <div class="col-lg-2">
                            <select name="paginate" onchange="changePagination(this.value)" id="" class="form-select">
                                <option value="10" selected>{{ __('pages.Show') }}</option>
                                <option value="10"
                                        @if(request('paginate') == 10) selected @endif>{{ __('pages.10') }}</option>
                                <option value="20"
                                        @if(request('paginate') == 20) selected @endif>{{ __('pages.20') }}</option>
                                <option value="50"
                                        @if(request('paginate') == 50) selected @endif>{{ __('pages.50') }}</option>
                                <option value="100"
                                        @if(request('paginate') == 100) selected @endif>{{ __('pages.100') }}</option>
                                <option value="200"
                                        @if(request('paginate') == 200) selected @endif>{{ __('pages.200') }}</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <form action="" class="row">
                                <div class="col-lg-5">
                                    <input type="date" value="{{ request('from_date') }}" class="form-control"
                                           name="from_date">
                                </div>
                                <div class="col-lg-5">
                                    <input type="date" value="{{ request('to_date') }}" class="form-control"
                                           name="to_date">
                                </div>
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-primary">
                                        Filter
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-4">
                            <form onsubmit="searchKeyword(e)">
                                <input type="text" id="search-keyword" name="keywords"
                                       value="{{ request('keywords') ??'' }}"
                                       placeholder="{{ __('pages.Search by invoice') }}" class="form-control">
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>{{ __('pages.sn') }}</th>
                                <th>{{ __('pages.date') }}</th>
                                <th>{{ __('Invoice ID') }}</th>
                                <th>{{ __('pages.customer') }}</th>
                                <th>{{ __('pages.Quantity') }}</th>
                                <th>{{ translate('Subtotal+Vat') }}</th>
                                <th>{{ translate('Discount') }}</th>
                                <th>{{ __('pages.total') }}</th>
                                <th>{{ __('pages.due') }}</th>
                                <th>{{ __('pages.option') }}</th>
                            </tr>
                            <tbody>
                            @forelse($invoices as $invoice)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $invoice->date }}</td>
                                    <td>{{ $invoice->inv_id }}</td>
                                    <td>{{ $invoice->customer ? $invoice->customer->name : 'Walk In Customer' }}</td>
                                    <td class="text-center">{{ $invoice->qty }}</td>
                                    <td class="text-center">{{ number_format($invoice->total_price,2) }}</td>
                                    <td class="text-center">{{ number_format($invoice->discount,2) }}</td>
                                    <td class="text-center">{{ number_format($invoice->paid_amount,2) }}</td>
                                    <td class="text-center">{{ number_format($invoice->due_price,2) }}</td>
                                    <td>
                                        @if($invoice->qty > 0)
                                            <a href="{{ route('invoice.print', $invoice->id) }}"
                                               class="btn btn-success btn-sm"><i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('returned', $invoice->id) }}"
                                               class="btn btn-warning btn-sm"><i class="fa fa-undo"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('invoice.print', $invoice->id) }}"
                                               class="btn btn-success btn-sm"><i class="fa fa-eye"></i>
                                            </a>
                                        @endif
                                    </td>
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
                    <div class="pagination mt-2">
                        {!! $invoices->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script>
        function changePagination(paginate) {
            var nurl = new URL('{{ route('invoice.reports') }}');
            nurl.searchParams.set('paginate', paginate);
            location.href = nurl;
        }


        function searchKeyword(e) {
            e.preventDefault();
            let keyword = $('#search-keyword')
            var nurl = new URL('{{ route('invoice.reports') }}');
            nurl.searchParams.set('keywords', keyword);
            location.href = nurl;
        }
    </script>
@endsection