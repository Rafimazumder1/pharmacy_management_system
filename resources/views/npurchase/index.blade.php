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
                    <h4 class="card-title mb-0">{{ __('pages.Purchase List') }}</h4>
                    <a href="{{ route('purchase.create') }}" class="btn btn-primary">{{ __('pages.New Purchase') }}</a>
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
                                    <input type="date" value="{{ request('from_date') }}" class="form-control" name="from_date">
                                </div>
                                <div class="col-lg-5">
                                    <input type="date" value="{{ request('to_date') }}" class="form-control" name="to_date">
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
                                <th scope="col">#</th>
                                <th scope="col">{{ __('pages.invoice_id') }}</th>
                                <th scope="col">{{ __('pages.Manufacture') }}</th>
                                <th scope="col">{{ __('pages.Date') }}</th>
                                <th scope="col">{{ __('pages.Quantity') }}</th>
                                <th scope="col">{{ __('pages.Subtotal') }}</th>
                                <th scope="col">{{ __('pages.Discount') }}</th>
                                <th scope="col">{{ __('pages.Total') }}</th>
                                <th scope="col">{{ __('pages.Due') }}</th>
                                <th scope="col">{{ __('pages.Created') }}</th>
                                <th scope="col">{{ __('pages.Action') }}</th>
                            </tr>
                            <tbody>

                            @forelse($purchases as $purchase)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $purchase->inv_id }}</td>
                                    <td>{{ $purchase->supplier ? $purchase->supplier->name : '-' }}</td>
                                    <td>{{ $purchase->date }}</td>
                                    <td class="text-center">{{ $purchase->qty }}</td>
                                    <td class="text-center">{{ number_format($purchase->subtotal,2) }}</td>
                                    <td class="text-center">{{ $purchase->discount }}</td>
                                    <td class="text-center">{{ number_format($purchase->total_price,2) }}</td>
                                    <td class="text-center">{{ number_format($purchase->due,2) }}</td>
                                    <td>{{ date('Y-m-d', strtotime($purchase->created_at)) }}</td>
                                    <td>
                                        <a href="{{ route('purchase.show', $purchase->id) }}"
                                           class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('purchase.return.form', $purchase->id) }}"
                                           class="btn btn-warning btn-sm"><i class="fa fa-undo"></i></a>
                                        <a onclick="return confirm('{{ __('pages.Are you sure to delete') }}')"
                                           href="{{ route('purchase.destroy', $purchase->id) }}"
                                           class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
                        {!! $purchases->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script>
        function changePagination(paginate) {
            var nurl = new URL('{{ route('purchase.index') }}');
            nurl.searchParams.set('paginate', paginate);
            location.href = nurl;
        }


        function searchKeyword(e) {
            e.preventDefault();
            let keyword = $('#search-keyword')
            var nurl = new URL('{{ route('purchase.index') }}');
            nurl.searchParams.set('keywords', keyword);
            location.href = nurl;
        }
    </script>
@endsection