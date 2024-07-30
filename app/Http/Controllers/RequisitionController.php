<?php 

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Requisitions;
use Illuminate\Http\Request;

class RequisitionController extends Controller
{
    public function index()
    {
        $requisitions = Requisitions::with('medicine')->get();
        $medicines = Medicine::all();
        return view('requisitions.index', compact('requisitions', 'medicines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'qty' => 'required|integer',
        ]);

        Requisitions::create($request->all());

        return redirect()->route('requisitions')->with('success', 'Requisition added successfully.');
    }

    public function edit($id)
    {
        $requisition = Requisitions::findOrFail($id);
        $medicines = Medicine::all();
        return view('requisitions.edit', compact('requisition', 'medicines'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'qty' => 'required|integer',
        ]);

        $requisition = Requisitions::findOrFail($id);
        $requisition->update($request->all());

        return redirect()->route('requisitions')->with('success', 'Requisition updated successfully.');
    }

    public function destroy($id)
    {
        $requisition = Requisitions::findOrFail($id);
        $requisition->delete();

        return redirect()->route('requisitions')->with('success', 'Requisition deleted successfully.');
    }
}