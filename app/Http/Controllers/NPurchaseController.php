<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Batch;
use App\Models\Medicine;
use App\Models\Method;
use App\Models\Purchase;
use App\Models\PurchasePay;
use App\Models\PurchaseReturn;
use App\Models\Supplier;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NPurchaseController extends Controller
{
    public function index(Request $request)
    {
        $to_date = $request->to_date ?? null;
        $from_date = $request->from_date ?? null;

        $paginate = 10;
        $query = Purchase::with('supplier', 'batch', 'method')->select('id', 'total_price', 'due_price', 'date', 'supplier_id', 'qty',
            'inv_id', 'subtotal', 'discount', 'method_id', 'created_at');
        if (!empty($request->paginate)) {
            $paginate = $request->paginate;
        }
        if (!empty($request->keywords)) {
            $keywords = '%' . $request->keywords . '%';
            $query->where(function ($query) use ($keywords) {
                $query->where('inv_id', 'LIKE', $keywords);
            });
        }
        if (!empty($from_date) && !empty($to_date)) {
            $query->whereBetween('created_at', [$from_date, $to_date]);
        }

        // $purchases = $query->latest()->paginate($paginate);

        // $purchases = DB::table('PURCHASES')
        //     ->select('ID', 'TOTAL_PRICE', 'DUE_PRICE', 'NEW_DATE', 'SUPPLIER_ID', 'QTY', 'INV_ID', 'SUBTOTAL', 'DISCOUNT', 'METHOD_ID', 'CREATED_AT')
        //     ->orderBy('CREATED_AT', 'desc')
        //     ->paginate(10);

        $purchases = Purchase::with('supplier')->orderBy('CREATED_AT', 'desc')->paginate(10);
        
        $supplier = Supplier::all();
        return view('npurchase.index', compact('purchases','supplier'));
    }

    public function create()
    {
        $query = Medicine::with('supplier')
            ->select('id', 'name', 'generic_name', 'price', 'image', 'supplier_id', 'strength');
        $search_products = $query->latest()->take(25)->get();
        $purchase_cart = session('purchase_cart', []);
        $suppliers = Supplier::select('id', 'name')->get();

        return view('npurchase.create', compact('search_products',
            'purchase_cart',
            'suppliers'
        ));
    }

    public function addToCart(Request $request)
    {
        $productId = $request->product_id;
        $product = Medicine::findOrFail($productId);

        $purchase_cart = session('purchase_cart', []);

        $cardData = [
            'id' => $product->id,
            'name' => $product->name,
            'image' => $product->image,
            'price' => $product->price,
            'leaf_id' => $product->leaf_id,
            'vat' => $product->vat,
            'buy_price' => $product->buy_price,
            'quantity' => 1,
            'batch_name' => null,
            'expire_date' => null,
            'discount' => 0,
            'discount_value_type' => 'percent',
            'sub_total' => 0,
            'total' => 0,
        ];

        if (array_key_exists($productId, $purchase_cart)) {
            $purchase_cart[$productId]['quantity'] += 1;
        } else {
            $purchase_cart[$productId] = $cardData;
        }
        session(['purchase_cart' => $purchase_cart]);
        return response()->json([
            'already_has' => 0,
            'added' => 1,
            'view' => view('npurchase.cart_table', compact('purchase_cart'))->render(),
        ]);
    }

    public function removeFromCart(Request $request)
    {
        $productId = $request->product_id;
        $purchase_cart = session('purchase_cart');
        if (array_key_exists($productId, $purchase_cart)) {
            $productId = $request->product_id;
            $purchase_cart = collect(session('purchase_cart')); // convert array to collection
            $purchase_cart->forget($productId); // use forget() method on the collection
            session(['purchase_cart' => $purchase_cart->toArray()]);
            return response()->json([
                'not_exsits' => 0,
                'removed' => 1,
                'view' => view('npurchase.cart_table', compact('purchase_cart'))->render(),
            ]);
        } else {
            return response()->json([
                'not_exsits' => 1,
                'removed' => 0,
                'view' => view('npurchase.cart_table', compact('purchase_cart'))->render(),
            ]);
        }
    }

    public function updateCart(Request $request)
    {
        $cartId = $request->cart_id;
        $field = $request->field;
        $value = $request->value;
        $purchase_cart = session('purchase_cart', []);
        if (array_key_exists($cartId, $purchase_cart)) {
            $purchase_cart[$cartId][$field] = $value;
        }
        session(['purchase_cart' => $purchase_cart]);
        $response = [
            'success' => 1,
            'error' => 0,
            'message' => 'Save changes!',
            'view' => view('npurchase.cart_table', compact('purchase_cart'))->render(),
        ];
        return response()->json($response);
    }

    public function store(Request $request)
    {
        $request->validate([
            'purchase_date' => 'required',
            'invoice_id' => 'required',
            'supplier_id' => 'required',
            'sub_total' => 'required',
            'total' => 'required',
            'payment_method_id' => 'required',
        ]);
        try {
            $balance = Method::find($request->input('payment_method_id'));

            if ($balance->balance < $request->input('total')) {
                throw new \Exception("Insufficient balance! your balance on $balance->name : $balance->balance");
            }

            $purchase_medicines = session('purchase_cart') ?? [];
            if (empty($purchase_medicines)) {
                throw new \Exception('Cart cannot be');
            }
            $data = [
                'date' => $request->purchase_date,
                'total_price' => $request->total,
                'due_price' => $request->due_amount,
                'supplier_id' => $request->supplier_id,
                'qty' => $request->total_quantity,
                'inv_id' => $request->invoice_id,
                'subtotal' => $request->sub_total,
                'discount' => $request->invoice_discount_amount + $request->medicine_discount,
                'method_id' => $request->payment_method_id,
            ];

            $data['shop_id'] = Auth::user()->shop_id;
            $data['district_id'] = Auth::user()->shop->district_id;
            $data['thana_id'] = Auth::user()->shop->thana_id;
            $purchase = Purchase::create($data);
            if ($purchase) {
                if ($request->due_amount > 0) {
                    $previus_due = Balance::where('supplier_id', $request->supplier_id)->first();
                    if (!empty($previus_due)) {
                        $previus_due->due += $request->due_amount;
                        $previus_due->save();
                    } else {
                        $previus_due = new Balance();
                        $previus_due->due = $request->due_amount;
                        $previus_due->supplier_id = $request->supplier_id;
                        $previus_due->save();
                    }
                }

                $invpay = new PurchasePay();
                $invpay->shop_id = Auth::user()->shop_id;
                $invpay->purchase_id = $purchase->id;
                $invpay->date = $request->purchase_date;
                $invpay->amount = $request->paid;
                $invpay->supplier_id = $request->supplier_id;
                $invpay->method_id = $request->payment_method_id;
                $invpay->save();

                $method = Method::find($request->payment_method_id);
                $method->balance -= $request->paid;
                $method->save();

                foreach ($purchase_medicines as $key => $medicine) {
                    $pmd['medicine_id'] = $key;
                    $pmd['purchase_id'] = $purchase->id;
                    $pmd['qty'] = $medicine['quantity'];
                    $pmd['purchase_qty'] = $medicine['quantity'];
                    $pmd['name'] = $medicine['batch_name'];
                    $pmd['price'] = $medicine['price'];
                    $pmd['buy_price'] = $medicine['buy_price'];
                    $pmd['expire'] = $medicine['expire_date'];
                    Batch::create($pmd);
                }
                session()->forget('purchase_cart');
                Toastr::success('Purchase created successfully!', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-top-right']);
                return redirect()->route('purchase.index');
            }
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-top-right']);
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $data['invoice'] = Purchase::where('id', $id)->first();
        $data['purchase_details'] = Batch::where('purchase_id', $id)->get();
        return view('npurchase.view')->with($data);
    }

    public function destroy($id)
    {
        try {
            $purchase = Purchase::find($id);
            if ($purchase->delete()) {
                Batch::where('purchase_id', $id)->delete();
                Toastr::success('Purchase deleted successfully!', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-top-right']);
                return redirect()->route('purchase.index');
            }
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-top-right']);
            return redirect()->back();
        }
    }

    public function returnHistory(Request $request)
    {
        $paginate = 10;
        if (!empty($request->paginate)) {
            $paginate = $request->paginate;
        }
        $return_data = PurchaseReturn::latest('id')->paginate($paginate);
        return view('npurchase.return_list', compact('return_data'));
    }

    public function showReturnForm($id)
    {
        $inv = Purchase::findorFail($id);
        $medicine = Batch::where('purchase_id', $id)->get();
        return view('npurchase.return_form', compact('inv', 'medicine'));
    }

    public function returnProcess(Request $request, $id)
    {
        $request->validate([
            'qty' => 'required',
            'medicine' => 'required',
        ]);
        $inv = Purchase::findorFail($id);
        $batch = Batch::where('medicine_id', $request->medicine)->where('purchase_id', $id)->first();
        if ($request->qty > $batch->qty) {
            Toastr::warning('Invalid quantity applyed! total quantity: ' . $batch->qty . '', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-top-right']);
            return redirect()->back();
        }

        $this->itemReturnMarge($batch, $inv, $request, $id);
        $this->invoiceReturnMarge($batch, $inv, $request, $id);

        Toastr::success('Return Accepted', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-top-right']);
        return redirect()->route('purchase.return');

    }

    protected function itemReturnMarge($item, $invoice, $request, $id)
    {
        $item->qty -= $request->qty;
        $item->save();
        $amt = ($item->buy_price * $request->qty);
        if ($invoice->supplier_id != 0) {
            $customer = Supplier::find($invoice->supplier_id);
            if ($customer->due >= $amt) {
                $customer->due -= $amt;
            }
            $customer->save();
        }
        $return = new PurchaseReturn();
        $return->date = date('Y-m-d');
        $return->purchae_id = $id;
        $return->batch_id = $item->id;
        $return->amount = $amt;
        $return->quantity = $request->qty;
        $return->shop_id = Auth::user()->shop_id;
        return $return->save();
    }

    protected function invoiceReturnMarge($batch, $inv, $request, $id)
    {
        $inv->qty -= $request->qty;
        $inv->total_price -= $batch->buy_price * $request->qty;
        $inv->subtotal -= $batch->buy_price * $request->qty;
        return $inv->save();
    }

    public function returnInvoice($id)
    {
        $return = PurchaseReturn::findOrFail($id);
        $invoice = Purchase::find($return->purchae_id);
        $purchase_details = Batch::where('purchase_id', $invoice->id)->get();
        return view('npurchase.return_invoice', compact('return', 'invoice', 'purchase_details'));

    }

    public function getMedicines(Request $request)
    {
        $query = Medicine::with('supplier')->select('id', 'name', 'generic_name', 'price', 'image', 'supplier_id', 'strength');
        if (!empty($request->keywords)) {
            $keywords = '%' . $request->keywords . '%';
            $query->where(function ($query) use ($keywords) {
                $query->where('name', 'LIKE', $keywords)
                    ->orWhere('generic_name', 'LIKE', $keywords);
            });
        }
        $search_products = $query->get();
        return response([
            'results' => view('npurchase.search_result', compact('search_products'))->render(),
        ]);
    }

    public function calculateCharge($value, $amount, $type)
    {
        if ($value && $type == 'percent') {
            return ($value / 100) * $amount;
        }
        if ($value && $type == 'fixed') {
            return $value;
        }
        return 0;
    }

}
