<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $collection = Patient::query()
            ->when($request->field && $request->keyword, function ($query) use ($request) {
                $query->where($request->field, 'LIKE', "%$request->keyword%");
            })
            ->paginate($request->input('limit',10));
        return view('patient.index', compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patient.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);
        try {
            $data = $request->except('_token');
            Patient::create($data);
            return redirect()->route('patient.index')->with('success', 'Successfully created');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        return view('patient.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $this->validation($request, $patient->id);
        try {
            $data = $request->except('_token','_method');
            $patient->update($data);
            return redirect()->route('patient.index')->with('success', 'Successfully updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        try {
            $patient->delete();
            return redirect()->route('patient.index')->with('success', 'Successfully deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    private function validation($request, $id = null)
    {
        return  $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'age' => 'required',
        ]);
    }
}
