@extends('layouts.app')
@section('title', __('Return History'))
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
                    <h4 class="card-title mb-0">{{ translate('Return History') }}</h4>
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
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('pages.date') }}</th>
                                <th scope="col">{{ __('pages.amount') }}</th>
                                <th scope="col">{{ __('pages.Quantity') }}</th>
                                <th scope="col"><i class="fa fa-cog"></i></th>
                            </tr>
                            <tbody>

                            @forelse($return_data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->amount}}</td>
                                    <td>{{ $item->quantity}}</td>
                                    <td>
                                        <a href="{{ route('purchase.return.invoice', $item->id) }}" class="btn btn-sm btn-primary ">
                                            {{ translate('Invoice') }}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <h4>{{ __('pages.No date found') }}!</h4>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination mt-2">
                        {!! $return_data->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script>
        function changePagination(paginate) {
            var nurl = new URL('{{ route('purchase.return') }}');
            nurl.searchParams.set('paginate', paginate);
            location.href = nurl;
        }

        function changeOrderStatus(status) {
            var nurl = new URL('{{ route('purchase.return') }}');
            nurl.searchParams.set('order_status', status);
            location.href = nurl;
        }

        function searchKeyword(e) {
            e.preventDefault();
            let keyword = $('#search-keyword')
            var nurl = new URL('{{ route('purchase.return') }}');
            nurl.searchParams.set('keywords', keyword);
            location.href = nurl;
        }
    </script>
@endsection