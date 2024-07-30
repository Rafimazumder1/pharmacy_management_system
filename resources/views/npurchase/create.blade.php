@extends('layouts.app')
@section('title', 'Ecommerce Order')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/purchase.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                    <h4 class="card-title mb-0">{{ __('pages.New Purchase') }}</h4>
                    <a href="{{ route('purchase.index') }}" class="btn btn-primary">{{ __('pages.Back') }}</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('purchase.store') }}" method="post">
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="">{{ __('pages.Date') }}</label>
                                <input type="date" name="purchase_date" value="{{ now()->format('Y-m-d') }}"
                                       class="form-control">
                                <span class="text-danger">@error('purchase_date') {{ $message }} @enderror </span>
                            </div>
                            <div class="col-lg-4">
                                <label for="">{{ __('pages.invoice_id') }}</label>
                                <input type="text" name="invoice_id" value="{{ 'INV'.rand(000000,999999) }}"
                                       class="form-control">
                                <span class="text-danger">@error('invoice_id') {{ $message }} @enderror </span>
                            </div>
                            <div class="col-lg-4">
                                <label for="supplier">{{ __('pages.Manufacture') }}</label>
                                <select name="supplier_id" id="supplier" class="form-select">
                                    <option value="">{{ __('pages.Select One') }}</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected':'' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('supplier_id') {{ $message }} @enderror </span>
                            </div>
                            <div class="col-lg-12 my-1">
                                <div class="searchfield position-relative">
                                    <div class="md-form form-sm form-2 pl-0 ">
                                        <input onfocus="searchProduct()" onkeyup="search()" class="form-control"
                                               id="searchInputField" type="text" value=""
                                               placeholder="{{ __('pages.Search by name or generic') }}"
                                               aria-label="Search" autocomplete="off">
                                    </div>
                                    <div class="search-suggestion-box d-none" id="scrollableDiv">
                                        <div class="infinite-scroll-component__outerdiv">
                                            <div class="infinite-scroll-component" id="searchResult">
                                                @include('npurchase.search_result')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="purchaseTable">
                                @include('npurchase.cart_table')
                            </div>

                            <div class="row justify-content-end mt-3">
                                <div class="col-lg-4">
                                    <button type="submit" class="btn btn-primary px-5 d-block w-100">
                                        {{ __('pages.submit') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script>
        $(document).ready(function () {
            $('body').removeClass('menu-expanded');
            $('body').addClass('menu-collapsed')
        });

        function search() {
            var keywords = $('#searchInputField').val();
            $.get({
                url: '{{ route('purchase.get_medicines') }}',
                data: {
                    keywords: keywords
                },
                success: function (data) {
                    $('#searchResult').empty().html(data.results);
                },
            });
        }

        function searchProduct() {
            $('#scrollableDiv').removeClass('d-none');
            $('#scrollableDiv').fadeIn();
        }

        $(document).ready(function () {
            $(document).mouseup(function (e) {
                var container = $(".searchfield");
                var box = $("#scrollableDiv");
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    box.fadeOut();
                }
            });
        });


        //  Add to cart
        function addToPurchaseCart(item_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.post({
                url: '{{ route('purchase.add_to_cart') }}',
                data: {product_id: item_id},
                beforeSend: function () {
                    // $('#loading').show();
                },
                success: function (data) {
                    toastr.success('Product has been added!', {
                        CloseButton: true,
                        ProgressBar: true,
                    });
                    $('#purchaseTable').empty().html(data.view);
                    $('#scrollableDiv').fadeOut();
                },
                complete: function () {
                    $('#loading').hide();
                }
            });
        }


        function removePurchaseItem(productId) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            // Get product by id
            $.post({
                url: '{{ route('purchase.remove_from_cart') }}',
                data: {product_id: productId},
                success: function (data) {
                    toastr.success('Item has been removed!', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    $('#purchaseTable').empty().html(data.view);
                },

            });
        }

        function changeHandler(value, cartId, item) {
            let data = {
                'cart_id': cartId,
                'field': item,
                'value': value,
            }
            updateCartItem(data);
        }

        // Update cart item when change anything in cart
        function updateCartItem(changedData) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            // Get product by id
            $.post({
                url: '{{ route('purchase.update_cart') }}',
                data: changedData,
                success: function (data) {
                    toastr.success(data.message, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    $('#purchaseTable').empty().html(data.view);
                },

            });
        }

        function calculateDueAmount() {
            let inv_discount_amount = $('#invoiceDiscountAmount').val();
            let inv_discount_type = $('#invoiceDiscountType').val();
            let subTotal = $('#subTotal').val();

            let dicount_amount = 0;
            if (inv_discount_type == 'percent') {
                dicount_amount = (Number(inv_discount_amount) / 100) * Number(subTotal);
            }
            if (inv_discount_type == 'fixed') {
                dicount_amount = Number(inv_discount_amount);
            }
            let total_amount = Number(subTotal) - dicount_amount;
            $('#totalAmountText').text(total_amount);
            $('#totalAmount').val(total_amount);
            let paid_amount = $('#paidAmount').val();
            $('#dueAmount').val(Number(total_amount) - Number(paid_amount));
        }
    </script>
@endsection