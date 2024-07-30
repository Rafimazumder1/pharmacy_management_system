<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Income;
use App\Models\Invoice;
use App\Models\InvoicePay;
use App\Models\Logo;
use App\Models\Medicine;
use App\Models\Purchase;
use App\Models\PurchasePay;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Toastr;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $date = date('Y-m-d', time());

        $data['customer'] = Invoice::select('total_price')->sum('total_price');
        $data['medicine'] = Batch::sum('qty');

        $data['invoice'] = Invoice::count();
        $data['purchase'] = Purchase::count();

        $data['invoice_amt'] = Invoice::sum('total_price');
        $data['purchase_amt'] = Purchase::sum('total_price');

        $data['received'] = InvoicePay::sum('amount');
        $data['paid'] = PurchasePay::sum('amount');

        $data['expire'] = Batch::where('expire', '<=', $date)->paginate(10);
        $data['expired_shop'] = Shop::where('next_pay', '<=', $date)->take(8)->get();

        $data['income'] = Income::where('status', 0)->take(8)->get();
        $data['stockout'] = Medicine::whereHas('batch', function ($query) {
            $query->where('qty', '<', 1);
        })->paginate(10);

        $data['expire_medicines'] = Batch::where('expire', '<=', $date)->paginate(10);
        $data['stockout_medicines'] = DB::table('medicines')
        ->select('medicines.id', 'medicines.name')
        ->leftJoin('batches', 'medicines.id', '=', 'batches.medicine_id')
        ->selectRaw('medicines.id, medicines.name, COALESCE(SUM(batches.qty), 0) AS total_quantity')
        ->groupBy('medicines.id', 'medicines.name')
        ->havingRaw('COALESCE(SUM(batches.qty), 0) < 1')
        ->get();

        // Medicine::select('id','name')
        //     ->withCount(['batch as total_quantity' => function ($query) {
        //         $query->select(DB::raw('sum(qty)'));
        //     }])
        //     ->having('total_quantity', '<', 1)
        //     ->get();
        return view('dashboard')->with($data);
    }

    public function settings(Request $request)
    {
        $shop = Shop::find(Auth::user()->shop_id);
        if ($request->isMethod('post')) {
            $shop->name = $request->name;
            $shop->site_title = $request->site_title;
            $shop->email = $request->email;
            $shop->phone = $request->phone;
            $shop->currency = $request->currency;
            $shop->address = $request->address;
            $shop->prefix = $request->prefix;
            $shop->theme = $request->theme;
            $shop->low_stock_alert = $request->low_stock_alert;
            $shop->time_zone = $request->time_zone;
            $shop->upcoming_expire_alert = $request->upcoming_expire_alert;
            // site logo
            if ($request->hasFile('site_logo')) {
                $image = $request->file('site_logo');
                $currentDate = Carbon::now()->toDateString();
                $logoimageName = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                if (!Storage::disk('public')->exists('images/admin/site_logo')) {
                    Storage::disk('public')->makeDirectory('images/admin/site_logo');
                }
                $logoImage = Image::make($image)->resize(100, 100)->stream();
                Storage::disk('public')->put('images/admin/site_logo/' . $logoimageName, $logoImage);
                $shop->site_logo = $logoimageName;
            } elseif (!empty($shop->site_logo)) {
                $shop->site_logo = $shop->site_logo;
            } else {
                $shop->site_logo = "default.png";
            }
            // favicon
            if ($request->hasFile('favicon')) {
                $image = $request->file('favicon');
                $currentDate = Carbon::now()->toDateString();
                $faviconimageName = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                if (!Storage::disk('public')->exists('images/admin/favicon')) {
                    Storage::disk('public')->makeDirectory('images/admin/favicon');
                }
                $favImage = Image::make($image)->resize(100, 100)->stream();
                Storage::disk('public')->put('images/admin/favicon/' . $faviconimageName, $favImage);
                $shop->favicon = $faviconimageName;
            } elseif (!empty($shop->favicon)) {
                $shop->favicon = $shop->favicon;
            } else {
                $shop->favicon = "default.png";
            }
            $shop->save();
            Toastr::success('Updated Succesfully', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-top-right']);
            return redirect()->back();
        }
        return view('settings', compact('shop'));
    }

    public function uploadLogo(Request $request)
    {
        $data = new Logo();
        if ($request->isMethod('post')) {
            Toastr::error('You are in demo mode!', 'Error!');
            return redirect()->back();
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $currentDate = Carbon::now()->toDateString();
                $imageName = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                if (!Storage::disk('public')->exists('images/admin/banner/' . $data->image)) {
                    Storage::disk('public')->makeDirectory('images/admin/banner/' . $data->image);
                }
                $logoImage = Image::make($image)->resize(100, 100)->stream();
                Storage::disk('public')->put('images/admin/banner/' . $imageName, $logoImage);
                $data->logo = $imageName;
            } else {
                $data->logo = "default.png";
            }
            $data->user_id = Auth::user()->id;
            $data->save();
            Toastr::success('Logo Uploaded!', 'Success!');
            return redirect()->back();
            die;
        }
    }
}