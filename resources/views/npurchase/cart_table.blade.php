@php
    $subtotal = 0;
    $total_discount = 0;
    $total_quantity = 0;
@endphp
<div class="table-responsive">
    <table class="table purchase-product-table table-striped mb-2">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ __('pages.medicine') }}</th>
            <th>{{ __('pages.batch') }}</th>
            <th>{{ __('pages.Expire Date') }}</th>
            <th>{{ __('pages.MRP Per Unit') }}</th>
            <th>{{ __('pages.Buy Price Per Unit') }}</th>
            <th>{{ __('pages.Quantity') }}</th>
            <th>{{ __('pages.Subtotal') }}</th>
            <th>{{ __('pages.Discount') }}</th>
            <th>{{ __('pages.Total') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($purchase_cart as $key => $cart)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="d-flex gap-1 align-items-center">
                    @if(!empty($cart['image']))
                        <img src="{{ asset('images/medicine/'.$cart['image']) }}" height="35" width="35" alt="">
                    @else
                        <img src="{{ asset('storage/images/medicine/default.png') }}" height="35" width="35" alt="">
                    @endif
                    <strong>{{ $cart['name'] }}</strong>
                </td>
                <td>
                    <input required class="text-uppercase" type="text"
                           onchange="changeHandler(this.value,'{{ $key }}','batch_name')"
                           value="{{ $cart['batch_name'] }}">
                </td>
                <td>
                    <input required onchange="changeHandler(this.value,'{{ $key }}','expire_date')"
                           style="width: 115px;"
                           type="date" value="{{ $cart['expire_date'] }}">
                </td>
                <td>
                    <input required step="any" onchange="changeHandler(this.value,'{{ $key }}','price')"
                           type="number"
                           value="{{ $cart['price'] }}">
                </td>
                <td>
                    <input required step="any" onchange="changeHandler(this.value,'{{ $key }}','buy_price')"
                           type="number"
                           value="{{ $cart['buy_price'] }}">
                </td>
                <td>
                    <input required onchange="changeHandler(this.value,'{{ $key }}','quantity')" type="number"
                           value="{{ $cart['quantity'] }}">
                </td>
                <td>
                    {{ number_format($cart['buy_price'] * $cart['quantity'] , 2 )}}
                </td>
                <td>
                    <input onchange="changeHandler(this.value,'{{ $key }}','discount')" type="number"
                           value="{{ $cart['discount'] }}">
                    <select onchange="changeHandler(this.value,'{{ $key }}','discount_value_type')">
                        <option value="percent" @if($cart['discount_value_type'] == 'percent') selected @endif>%
                        </option>
                        <option value="fixed" @if($cart['discount_value_type'] == 'fixed') selected @endif>Fixed
                        </option>
                    </select>
                </td>
                <td>
                    @php
                        $calucaton = new \App\Http\Controllers\NPurchaseController();
                        $dicount_amoount = $calucaton->calculateCharge($cart['discount'],$cart['buy_price'],$cart['discount_value_type']);
                    @endphp
                    {{ number_format(($cart['buy_price'] * $cart['quantity']) -  $dicount_amoount , 2)  }}
                </td>
                <td>
                    <a href="javascript:" onclick="removePurchaseItem('{{$key}}')" class="text-danger"><i
                                class="fa fa-times"></i></a>
                </td>
            </tr>
            @php
                $total_discount += $dicount_amoount;
                $subtotal += ($cart['buy_price'] * $cart['quantity']);
                $total_quantity += $cart['quantity'];
            @endphp
        @empty
            <tr>
                <td colspan="11" class="text-center">
                    <h5 class="font-weight-bold py-2">{{ __('pages.Purchase cart empty') }}</h5>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
<div class="row justify-content-end">
    <div class="col-lg-4">
        <div class="float-end">
            <table class="table estimate-acount-table text-right">
                <tr>
                    <th>{{ __('pages.Subtotal') }}</th>
                    <td>:</td>
                    <td>{{ number_format($subtotal, 2) }}</td>
                    <input type="hidden" id="subTotal" name="sub_total" value="{{ $subtotal }}">
                </tr>
                <tr>
                    <th>{{ __('pages.Medicines Discount') }}</th>
                    <td>:</td>
                    <td>
                        {{ number_format($total_discount,2) }}
                    </td>
                    <input type="hidden" name="medicine_discount" value="{{ $total_discount }}">
                </tr>
                <tr>
                    <th>{{ __('pages.Invoice Discount') }}</th>
                    <td>:</td>
                    <td>
                        <input onchange="calculateDueAmount()" id="invoiceDiscountAmount" name="invoice_discount_amount"
                               type="number"
                               value="0">
                        <select onchange="calculateDueAmount()" id="invoiceDiscountType" name="invoice_discount_type">
                            <option value="percent">%</option>
                            <option value="fixed">{{ __('pages.Fixed') }}</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>{{ __('pages.Total') }}</th>
                    <td>:</td>
                    <td><span id="totalAmountText">{{ number_format($subtotal - $total_discount , 2) }}</span></td>
                    <input type="hidden" id="totalAmount" name="total" value="{{ $subtotal - $total_discount }}">
                </tr>
                <tr>
                    <th>{{ __('pages.Paid Amount') }}</th>
                    <td>:</td>
                    <td>
                        <input onchange="calculateDueAmount()" id="paidAmount" type="number" name="paid"
                               value="{{ $subtotal - $total_discount }}">
                    </td>
                </tr>
                <tr>
                    <th>{{ __('pages.Due Amount') }}</th>
                    <td>:</td>
                    <td>
                        <input id="dueAmount" type="number" name="due_amount" value="0">
                    </td>
                </tr>
                <tr>
                    <th>{{ __('pages.Payment Method') }}</th>
                    <td>:</td>
                    <td>
                        @php
                            $payment_methods = \App\Models\Method::select('id', 'name')->get();
                        @endphp
                        <select style="width: 100%;" name="payment_method_id">
                            <option value="">{{ __('pages.Select One') }}</option>
                            @foreach($payment_methods as $payment_method)
                                <option value="{{ $payment_method->id }}" {{ old('payment_method_id') == $payment_method->id ? 'selected':'' }}>
                                    {{ $payment_method->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('payment_method_id') {{ $message }} @enderror </span>
                    </td>
                    <input type="hidden" name="total_quantity" value="{{ $total_quantity }}">
                </tr>
            </table>
        </div>
    </div>
</div>