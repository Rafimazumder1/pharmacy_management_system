<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CrudeRepository;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $collection = Doctor::latest()
            ->when($request->field && $request->keyword, function ($query) use ($request) {
                $query->where($request->field, 'LIKE', "%$request->keyword%");
            })->paginate($request->input('limit', 10));
        return view('doctor.index', compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);
        try {
            $data = $request->except('_token');
            Doctor::create($data);
            return redirect()->route('doctor.index')->with('success', 'Successfully created');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        return view('doctor.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $this->validation($request, $doctor->id);
        try {
            $data = $request->except('_token', '_method');
            $doctor->update($data);
            return redirect()->route('doctor.index')->with('success', 'Successfully updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        try {
            $doctor->delete();
            return redirect()->route('doctor.index')->with('success', 'Successfully deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    private function validation($request, $id = null)
    {
        return $request->validate([
            'name' => 'required|unique:doctors,name,' . $id,
            'phone' => 'required',
            'title' => 'required',
            'speciality' => 'required',
        ]);
    }
}
