<?php
namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\Upazila;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function add()
    {
        $divisions = Division::all();
        $upzila = Upazila::all();
        $divisions = Division::all();
        return view('shop.add', compact('divisions','upzila'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        // Create the shop
        $shop = new Shop();
        $shop->name = $request->name;
        $shop->phone = $request->phone;
        $shop->address = $request->address;
        $shop->save();

        // Redirect or respond with success message
        return redirect()->back()->with('success', 'Shop added successfully');
    }

    public function shops()
    {
        $divisions = Division::all();
        $dd = District::all();
        $upzila = Upazila::all();
        $shops = Shop::all();
        return view('shop.shops', compact('divisions','dd', 'upzila','shops'));
    }
    public function index(Request $request)
    {
        $shops = Shop::all();
        return view('shop.list', compact('shops'));
    }
    public function edit($id)
    {
        $shop = Shop::findOrFail($id);
        return view('shop.edit', compact('shop'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        // Find the shop by ID
        $shop = Shop::findOrFail($id);

        // Update shop details
        $shop->name = $request->input('name');
        $shop->phone = $request->input('phone');
        $shop->address = $request->input('address');
        $shop->language = $request->input('language');
        $shop->last_renew = $request->input('last_renew');
        $shop->low_stock_alert = $request->input('low_stock_alert');
        $shop->next_pay = $request->input('next_pay');
        $shop->package_id = $request->input('package_id');
        $shop->prefix = $request->input('prefix');
        $shop->shop_id = $request->input('shop_id');
        $shop->site_title = $request->input('site_title');
        $shop->status = $request->input('status');
        $shop->system_default_currency = $request->input('system_default_currency');
        $shop->thana_id = $request->input('thana_id');
        $shop->theme = $request->input('theme');
        $shop->time_zone = $request->input('time_zone');
        $shop->union_id = $request->input('union_id');
        $shop->upazilla_id = $request->input('upazilla_id');
        $shop->upcoming_expire_alert = $request->input('upcoming_expire_alert');
        $shop->username = $request->input('username');

        // Handle file uploads
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images/shops', 'public');
            $shop->image = basename($imagePath);
        }

        if ($request->hasFile('site_logo')) {
            $siteLogo = $request->file('site_logo');
            $siteLogoPath = $siteLogo->store('images/shops', 'public');
            $shop->site_logo = basename($siteLogoPath);
        }

        // Save the updated shop
        $shop->save();

        // Redirect or respond with success message
        return redirect()->route('shop.list')->with('success', 'Shop updated successfully');
    }

    public function view($id)
    {
        $shop = Shop::findOrFail($id);
        return view('shop.view', compact('shop'));
    }

    public function getDistricts($division_id)
    {
        $districts = District::where('division_id', $division_id)->get();
        return response()->json($districts);
    }
    public function delete($id)
    {
        $shop = Shop::findOrFail($id);
        $shop->delete();
    
        return redirect()->route('shop.list')->with('success', 'Shop deleted successfully');
    }
}
