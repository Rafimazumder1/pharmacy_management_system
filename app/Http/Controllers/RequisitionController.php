<?php 

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\shop;
use App\Models\Requisitions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Exception;
class RequisitionController extends Controller

    {
        public function index()
        {
            // Retrieve temporary requisitions from session
            $requisitions = session()->get('temporary_requisitions', []);
            
            // Fetch medicines to populate the dropdown
            $medicines = Medicine::all();
            
            // Retrieve the req_id from the session or set it to null if not present
            $req_id = session()->get('req_id', null);
            
            // Pass the requisitions, medicines, and req_id to the view
            return view('requisitions.index', compact('requisitions', 'medicines', 'req_id'));
        }
    

        public function store(Request $request)
        {
            // Validate the request
            $validated = $request->validate([
                'req_id' => 'required|string',
                'medicines.*.medicine_id' => 'required|exists:medicines,id',
                'medicines.*.qty' => 'required|numeric',
            ]);
    
            // Retrieve the req_id from the request
            $req_id = $validated['req_id'];
    
            // Retrieve the existing requisitions from the session or initialize an empty array
            $requisitions = session()->get('temporary_requisitions', []);
            $found = false;
    
            // Check if the requisition ID already exists
            foreach ($requisitions as &$requisition) {
                if ($requisition['req_id'] === $req_id) {
                    // Update the existing requisition
                    foreach ($request->medicines as $medicine) {
                        $requisition['medicines'][] = [
                            'medicine_id' => $medicine['medicine_id'],
                            'qty' => $medicine['qty'],
                        ];
                    }
                    $found = true;
                    break;
                }
            }
    
            if (!$found) {
                // Create a new requisition entry
                $requisitions[] = [
                    'req_id' => $req_id,
                    'medicines' => array_map(function ($medicine) {
                        return [
                            'medicine_id' => $medicine['medicine_id'],
                            'qty' => $medicine['qty'],
                        ];
                    }, $request->medicines),
                ];
            }
    
            // Store the updated requisitions array in the session
            session()->put('temporary_requisitions', $requisitions);
    
            // Store the req_id in session for future reference
            session()->put('req_id', $req_id);
    
            return redirect()->route('requisitions')->with('success', 'Requisition added temporarily.');
        }


    
        public function edit($req_id)
        {
            $requisitions = session()->get('temporary_requisitions', []);
    
            // Find the requisition with the specified ID
            $requisition = collect($requisitions)->firstWhere('req_id', $req_id);
    
            if (!$requisition) {
                return redirect()->route('requisitions')->with('error', 'Requisition not found.');
            }
    
            $medicines = Medicine::all(); // Fetch all medicines from the database
    
            return view('requisitions.index', [
                'requisition' => $requisition,
                'medicines' => $medicines
            ]);
        }
    

        public function update(Request $request)
        {
            $validated = $request->validate([
                'req_id' => 'required|string',
                'medicine_id.*' => 'required|exists:medicines,id',
                'qty.*' => 'required|numeric',
            ]);
    
            $requisitions = session()->get('temporary_requisitions', []);
    
            $requisitions = array_map(function ($item) use ($validated) {
                if ($item['req_id'] === $validated['req_id']) {
                    $item['medicines'] = array_map(function ($medicine_id, $index) use ($validated) {
                        return [
                            'medicine_id' => $medicine_id,
                            'qty' => $validated['qty'][$index],
                        ];
                    }, $validated['medicine_id'], array_keys($validated['medicine_id']));
                }
                return $item;
            }, $requisitions);
    
            session()->put('temporary_requisitions', $requisitions);
    
            return redirect()->route('detailreq')->with('success', 'Requisition updated successfully.');
        }
    

        public function save(Request $request)
    {
        // Retrieve temporary requisitions from session
        $temporaryRequisitions = session()->get('temporary_requisitions', []);
        
        if (empty($temporaryRequisitions)) {
            return redirect()->back()->with('error', 'No requisitions to save.');
        }

        // Retrieve shop ID from the authenticated user or other source
        $shopId = Auth::user()->shop_id; // Adjust based on your user model

        // Example of inserting requisitions into database
        foreach ($temporaryRequisitions as $requisition) {
            // Insert requisition details into the database
            $reqId = $requisition['req_id']; // Use a unique identifier for requisition

            // Insert requisition header
            DB::table('REQ')->insert([
                'ID' => $reqId,
                'SHOP_ID' => $shopId,
                'USER_ID'=>Auth::user()->id,
                'CREATED_AT' => now(),
                'CREATED_BY' => Auth::user()->id, // Adjust if needed
            ]);

            // Insert medicines into requisition details table
            foreach ($requisition['medicines'] as $medicine) {
                DB::table('REQ_DET')->insert([
                    'REQ_ID' => $reqId,
                    'SHOP_ID' => $shopId,
                    'MEDICINE_ID' => $medicine['medicine_id'],
                    'USER_ID'=>Auth::user()->id,
                    'QTY' => $medicine['qty'],
                    'CREATED_AT' => now(),
                    'CREATED_BY' => Auth::user()->id, // Adjust if needed
                ]);
            }
        }

        // Clear temporary requisitions from session
        session()->forget('temporary_requisitions');

        return redirect()->route('requisitions')->with('success', 'Requisitions saved successfully.');
    }
    

        public function destroy($req_id)
        {
            // Retrieve the existing requisitions from session
            $requisitions = session()->get('temporary_requisitions', []);
    
            // Filter out the requisition with the specified ID
            $requisitions = array_filter($requisitions, function ($requisition) use ($req_id) {
                return $requisition['req_id'] !== $req_id;
            });
    
            // Re-index the array to avoid potential issues with keys
            $requisitions = array_values($requisitions);
    
            // Store the updated requisitions array back in the session
            session()->put('temporary_requisitions', $requisitions);
    
            // Redirect back with a success message
            return redirect()->route('requisitions')->with('success', 'Requisition deleted successfully.');
        }

    
        public function detail()
        {
            $requisitions = session()->get('temporary_requisitions', []);
            
            // Fetch medicines to populate the dropdown
            $medicines = Medicine::all();
            
            return view('requisitions.detail', compact('requisitions', 'medicines'));
        }
    

        public function resetRequisitions()
{
    // Clear temporary requisitions from session
    session()->forget('temporary_requisitions');
    session()->forget('req_id'); // Optionally clear req_id as well

    return redirect()->route('requisitions');


}
        public function olo()
{
    
    return view('requisitions.olo');

}



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


public function showRequisitionsByShop(Request $request)
{
    // Fetch all shops that the user has access to (customize this based on your application's logic)
    $shops = DB::table('SHOPS')->get();

    // Retrieve the shop ID from the request or default to the first shop in the list
    $shopId = $request->input('shop_id', $shops->first()->id);

    // Fetch the APPR_1 filter from the request (default to 'N' if not provided)
    $approvalStatus = $request->input('appr', 'N');

    // Query to fetch requisitions where SHOP_ID matches and APPR_1 matches the provided status
    $requisitions = DB::table('REQ')
        ->select('ID', 'APPR_1')
        ->where('SHOP_ID', $shopId)
        ->where('APPR_1', $approvalStatus)
        ->get();

    // Pass the shops, requisitions, selected shop ID, and approval status to the view
    return view('requisitions.detail', compact('shops', 'requisitions', 'shopId', 'approvalStatus'));
}


// public function showDetails($id)
// {
//     // Fetch requisition details by REQ_ID from REQ_DET table
//     $requisitionDetails = DB::table('REQ_DET')
//         ->where('REQ_ID', $id)
//         ->get();

//     // Fetch the requisition itself for any additional information if needed
//     $requisition = DB::table('REQ')->find($id);

//     // Fetch all medicines using Eloquent model if you have one
//     $medicines = Medicine::all();

//     // Pass the requisition details, requisition, and medicines to the view
//     return view('requisitions.details', compact('requisitionDetails', 'requisition', 'medicines'));
// }


// public function updateDetails(Request $request, $id)
// {
//     // Update the REQ_DEL table with the edited details
//     foreach ($request->input('details') as $detail) {
//         DB::table('REQ_DET')
//             ->where('REQ_ID', $id)
//             ->where('MEDICINE_ID', $detail['medicine_id'])
//             ->update([
//                 'QTY' => $detail['qty'],
//                 // add other fields to update if necessary
//             ]);
//     }

//     return redirect()->route('requisitions.details', $id)->with('success', 'Details updated successfully.');
// }

public function showDetails($id)
{
    // Fetch requisition details by REQ_ID from REQ_DET table
    $requisitionDetails = DB::table('REQ_DET')
        ->where('REQ_ID', $id)
        ->get();

    // Fetch the requisition itself for any additional information if needed
    $requisition = DB::table('REQ')->find($id);

    // Fetch all medicines using Eloquent model if you have one
    $medicines = Medicine::all()->keyBy('id');

    // Pass the requisition details, requisition, and medicines to the view
    return view('requisitions.details', compact('requisitionDetails', 'requisition', 'medicines'));
}




public function updateDetails(Request $request, $id)
{
    try {
        foreach ($request->input('details') as $medicineId => $detail) {
            DB::table('REQ_DET')
                ->where('REQ_ID', $id)
                ->where('MEDICINE_ID', $medicineId)
                ->update([
                    'MEDICINE_ID' => $detail['medicine_id'],
                    'QTY' => $detail['qty'],
                ]);
        }

        return redirect()->route('requisitions.details', $id)->with('success', 'Details updated successfully.');
    } catch (Exception $e) {
        return redirect()->route('requisitions.details', $id)->with('error', 'Failed to update details: ' . $e->getMessage());
    }
}
















}
    
    


// public function index()
    // {
    //     $requisitions = Requisitions::with('medicine','shop')->get();
    //     $medicines = Medicine::all();
    //     $shops = Shop::all(); // Get all shops
    //     return view('requisitions.index', compact('requisitions', 'medicines', 'shops'));
    // }
    // public function detail()
    // {
    //     $requisitions = Requisitions::with('medicine', 'shop')->get();
    //     $medicines = Medicine::all();
    //     $shops = Shop::all();

    //     return view('requisitions.detail', compact('requisitions', 'medicines', 'shops'));
    // }

//     public function store(Request $request)
// {
//     try {
//         $status = 0;

//         $existingReq = DB::table('BPDB_PHARMACY.REQ_DET')->where('REQ_ID', $request->req_id)->first();

//         if ($existingReq) {
//             return redirect()->back()->with('error', 'Requisition with this ID already exists.')->withInput();
//         }

//         DB::beginTransaction();
//         try {
//             DB::statement("
//                 BEGIN 
//                     BPDB_PHARMACY.DPg_Req.dpd_req_det_insert(
//                         :status, 
//                         :reqId, 
//                         :shopId, 
//                         :qnty, 
//                         :medicineId, 
//                         :userId
//                     ); 
//                 END;", [
//                 'status' => &$status,
//                 'reqId' => $request->req_id, // Assuming you have this from the previous procedure
//                 'shopId' => auth()->user()->shop_id,
//                 'qnty' => $request->qty,
//                 'medicineId' => $request->medicine_id,
//                 'userId' => auth()->id()
//             ]);
//             Log::info('Procedure status:', ['status' => $status]);
//             if ($status == 1) {
//                 DB::commit();
//                 return redirect()->route('requisitions')->with('success', 'Requisition detail inserted successfully!');
//             } else {
//                 DB::rollBack();
//                 return redirect()->back()->with('error', 'Failed to insert requisition detail.')->withInput();
//             }
//         } catch (\Exception $e) {
//             DB::rollBack();
//             return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
//         }
//     } catch (\Exception $e) {
//         return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
//     }
// }





























// public function destroy($index)
// {
//     $requisitions = session()->get('temporary_requisitions', []);
    
//     if (isset($requisitions[$index])) {
//         unset($requisitions[$index]);
//         session()->put('temporary_requisitions', array_values($requisitions));
//     }

//     return redirect()->route('requisitions')->with('success', 'Requisition removed from temporary list.');
// }


// public function edit($id)
// {
//     try {
//         // Fetch the specific requisition detail by its ID
//         $requisition = Requisitions::find($id); // Use Eloquent model

//         if (!$requisition) {
//             return redirect()->route('requisitions')->with('error', 'Requisition not found.');
//         }

//         // Retrieve all medicines and shops for dropdowns in the edit form
//         $medicines = Medicine::all(); // Use Eloquent model
//         $shops = Shop::all(); // Use Eloquent model

//         // Pass data to the view
//         return view('requisitions.edit', compact('requisition', 'medicines', 'shops'));
//     } catch (\Exception $e) {
//         return redirect()->route('requisitions')->with('error', 'An error occurred: ' . $e->getMessage());
//     }
// }





// public function update(Request $request, $id)
// {
//     try {
//         // Validate the request data
//         $validatedData = $request->validate([
//             'new_medicine_id' => 'required|exists:medicines,id',
//             'qty' => 'required|numeric',
//         ]);

//         // Fetch the requisition to be updated
//         $requisition = Requisitions::find($id);

//         if (!$requisition) {
//             return redirect()->route('requisitions')->with('error', 'Requisition not found.');
//         }

//         $status = 0;
        
//         // Begin a database transaction
//         DB::beginTransaction();

//         try {
//             // Call the stored procedure for updating requisition details
//             DB::statement("
//                 BEGIN 
//                     BPDB_PHARMACY.DPg_Req.dpd_req_det_Update(
//                         :status, 
//                         :reqId, 
//                         :shopId, 
//                         :qty, 
//                         :medicineId, 
//                         :userId
//                     ); 
//                 END;", [
//                 'status' => &$status,
//                 'reqId' => $id,
//                 'shopId' => auth()->user()->shop_id,
//                 'qty' => $request->input('qty'),
//                 'medicineId' => $request->input('new_medicine_id'),
//                 'userId' => auth()->id()
//             ]);

//             // Check the status returned from the procedure
//             if ($status == 1) {
//                 DB::commit();
//                 return redirect()->route('requisitions.save', ['id' => $id])->with('success', 'Requisition updated successfully!');
//             } else {
//                 DB::rollBack();
//                 return redirect()->back()->with('error', 'Failed to update requisition detail.')->withInput();
//             }
//         } catch (\Exception $e) {
//             DB::rollBack();
//             return redirect()->route('requisitions.save')->with('success', 'Requisition updated successfully!');
//         }
//     } catch (\Exception $e) {
//         return redirect()->route('requisitions.save')->with('success', 'Requisition updated successfully!');
//     }
// }

// public function save($id)
// {
//     try {
//         // Prepare the stored procedure call
//         $cursor = null;
//         $bindings = [
//             'p_cur_data' => $cursor,
//             'p_req_id' => $id,
//         ];

//         // Execute the stored procedure
//         DB::executeProcedure('BPDB_PHARMACY.DPg_Req.dpd_req_select', $bindings);

//         // Fetch the requisition data from the cursor
//         $requisitions = [];
//         while ($row = oci_fetch_assoc($cursor)) {
//             $requisitions[] = (object) $row;
//         }
//         oci_free_statement($cursor);

//         // Check if the requisition was found
//         if (empty($requisitions)) {
//             return redirect()->route('requisitionss')->with('error', 'Requisition not found.');
//         }

//         // Return the view with the requisition data
//         return view('requisitions.detail', compact('requisitions'));

//     } catch (\Exception $e) {
//         // Handle exceptions and log errors
//         return redirect()->route('requisitions')->with('error', 'An error occurred while fetching the requisition.');
//     }
// }


//     public function destroy($id)
//     {
//         $requisition = Requisitions::findOrFail($id);
//         $requisition->delete();

//         return redirect()->route('requisitions')->with('success', 'Requisition deleted successfully.');
//     }
