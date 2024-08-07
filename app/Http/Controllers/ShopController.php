<?php
// namespace App\Http\Controllers;

// use App\Models\District;
// use App\Models\Division;
// use App\Models\Upazila;
// use App\Models\Shop;
// use Illuminate\Http\Request;

// class ShopController extends Controller
// {
//     public function add()
//     {
//         $divisions = Division::all();
//         $upzila = Upazila::all();
//         $divisions = Division::all();
//         return view('shop.add', compact('divisions','upzila'));
//     }

//     public function store(Request $request)
//     {
        
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'phone' => 'required|string|max:20',
//             'address' => 'required|string|max:255',
//         ]);

        
//         $shop = new Shop();
//         $shop->name = $request->name;
//         $shop->phone = $request->phone;
//         $shop->address = $request->address;
//         $shop->save();

      
//         return redirect()->back()->with('success', 'Shop added successfully');
//     }

//     public function shops()
//     {
//         $divisions = Division::all();
//         $dd = District::all();
//         $upzila = Upazila::all();
//         $shops = Shop::all();
//         return view('shop.shops', compact('divisions','dd', 'upzila','shops'));
//     }
//     public function index(Request $request)
//     {
//         $shops = Shop::all();
//         return view('shop.list', compact('shops'));
//     }
//     public function edit($id)
//     {
//         $shop = Shop::findOrFail($id);
//         return view('shop.edit', compact('shop'));
//     }

//     public function update(Request $request, $id)
//     {
        
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'phone' => 'required|string|max:20',
//             'address' => 'nullable|string|max:255',
//         ]);

        
//         $shop = Shop::findOrFail($id);

        
//         $shop->name = $request->input('name');
//         $shop->phone = $request->input('phone');
//         $shop->address = $request->input('address');
//         $shop->language = $request->input('language');
//         $shop->last_renew = $request->input('last_renew');
//         $shop->low_stock_alert = $request->input('low_stock_alert');
//         $shop->next_pay = $request->input('next_pay');
//         $shop->package_id = $request->input('package_id');
//         $shop->prefix = $request->input('prefix');
//         $shop->shop_id = $request->input('shop_id');
//         $shop->site_title = $request->input('site_title');
//         $shop->status = $request->input('status');
//         $shop->system_default_currency = $request->input('system_default_currency');
//         $shop->thana_id = $request->input('thana_id');
//         $shop->theme = $request->input('theme');
//         $shop->time_zone = $request->input('time_zone');
//         $shop->union_id = $request->input('union_id');
//         $shop->upazilla_id = $request->input('upazilla_id');
//         $shop->upcoming_expire_alert = $request->input('upcoming_expire_alert');
//         $shop->username = $request->input('username');

//         // Handle file uploads
//         if ($request->hasFile('image')) {
//             $image = $request->file('image');
//             $imagePath = $image->store('images/shops', 'public');
//             $shop->image = basename($imagePath);
//         }

//         if ($request->hasFile('site_logo')) {
//             $siteLogo = $request->file('site_logo');
//             $siteLogoPath = $siteLogo->store('images/shops', 'public');
//             $shop->site_logo = basename($siteLogoPath);
//         }

//         // Save the updated shop
//         $shop->save();

//         // Redirect or respond with success message
//         return redirect()->route('shop.list')->with('success', 'Shop updated successfully');
//     }

//     public function view($id)
//     {
//         $shop = Shop::findOrFail($id);
//         return view('shop.view', compact('shop'));
//     }

//     public function getDistricts($division_id)
//     {
//         $districts = District::where('division_id', $division_id)->get();
//         return response()->json($districts);
//     }
//     public function delete($id)
//     {
//         $shop = Shop::findOrFail($id);
//         $shop->delete();
    
//         return redirect()->route('shop.list')->with('success', 'Shop deleted successfully');
//     }
// }

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\Shop;
use Illuminate\Http\Request;
// use DB;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class ShopController extends Controller
{
    public function add()
    {
        $divisions = Division::all();
        return view('shop.add', compact('divisions'));
    }

    public function store(Request $request)
{
    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'address' => 'required|string|max:255',
        'division' => 'required|integer',
        'district' => 'required|integer',
        'Thanas' => 'required|integer',
    ]);

    // Create the shop
    $shop = new Shop();
    $shop->name = $request->name;
    $shop->phone = $request->phone;
    $shop->address = $request->address;
    $shop->division_id = $request->division;
    $shop->district_id = $request->district;
    $shop->thana_id = $request->Thanas;
    $shop->site_title = $request->site_title;

    // Handle file upload for site_logo
    if ($request->hasFile('site_logo')) {
        $siteLogo = $request->file('site_logo');
        $siteLogoPath = $siteLogo->store('images/shops', 'public');
        $shop->site_logo = basename($siteLogoPath);
    }

    // Save the shop to the database
    $shop->save();

    // Redirect or respond with success message
    return redirect()->back()->with('success', 'Shop added successfully');
}


    public function shops()
    {
        $divisions = Division::all();
        $shops = Shop::all();
        return view('shop.shops', compact('divisions', 'shops'));
    }
    public function index(Request $request)
    {
        $shops = Shop::all();
        return view('shop.list', compact('shops'));
    }





    public function edit($id)
    {
        $shop = Shop::findOrFail($id);
        $divisions = Division::all();
        return view('shop.edit', compact('shop', 'divisions'));
    }
    
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'address' => 'nullable|string|max:500',
            'site_title' => 'nullable|string|max:255',
            'status' => 'nullable|integer',
            'division' => 'nullable|integer',
            'district' => 'nullable|integer',
            'thana' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        try {
            // Start a database transaction
            DB::beginTransaction();
    
            // Prepare the update data
            $updateData = [
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'address' => $validated['address'] ?? null,
                'site_title' => $validated['site_title'] ?? null,
                'status' => $validated['status'] ?? null,
                'division_id' => $validated['division'] ?? null,
                'district_id' => $validated['district'] ?? null,
                'thana_id' => $validated['thana'] ?? null,
            ];
    
            // Handle file uploads
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                $oldImage = DB::table('shops')->where('id', $id)->value('image');
                if ($oldImage) {
                    Storage::disk('public')->delete('images/shops/' . $oldImage);
                }
                // Store the new image
                $image = $request->file('image');
                $imagePath = $image->store('images/shops', 'public');
                $updateData['image'] = basename($imagePath);
            }
    
            if ($request->hasFile('site_logo')) {
                // Delete the old site logo if it exists
                $oldSiteLogo = DB::table('shops')->where('id', $id)->value('site_logo');
                if ($oldSiteLogo) {
                    Storage::disk('public')->delete('images/shops/' . $oldSiteLogo);
                }
                // Store the new site logo
                $siteLogo = $request->file('site_logo');
                $siteLogoPath = $siteLogo->store('images/shops', 'public');
                $updateData['site_logo'] = basename($siteLogoPath);
            }
    
            // Perform the update
            DB::table('shops')->where('id', $id)->update($updateData);
    
            // Commit the transaction
            DB::commit();
    
            // Redirect or respond with success message
            return redirect()->route('shop.list')->with('success', 'Shop updated successfully');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();
            // Handle the exception
            return redirect()->back()->with('error', 'Failed to update shop: ' . $e->getMessage());
        }
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

    public function getThanas($districtId)
{
    $thanas = DB::table('THANAS')->where('DISTRICT_ID', $districtId)->get();
    return response()->json($thanas);
}
public function delete($id)
{
    try {
        // Start a database transaction
        DB::beginTransaction();

        // Retrieve the image and site logo paths
        $shop = DB::table('shops')->where('id', $id)->first();
        if (!$shop) {
            return redirect()->back()->with('error', 'Shop not found');
        }

        // Delete the image file if it exists
        if ($shop->image) {
            Storage::disk('public')->delete('images/shops/' . $shop->image);
        }

        // Delete the site logo file if it exists
        if ($shop->site_logo) {
            Storage::disk('public')->delete('images/shops/' . $shop->site_logo);
        }

        // Delete the shop record
        DB::table('shops')->where('id', $id)->delete();

        // Commit the transaction
        DB::commit();

        // Redirect or respond with success message
        return redirect()->route('shop.list')->with('success', 'Shop deleted successfully');
    } catch (\Exception $e) {
        // Rollback the transaction if something goes wrong
        DB::rollBack();
        // Handle the exception
        return redirect()->back()->with('error', 'Failed to delete shop: ' . $e->getMessage());
    }
}


}
