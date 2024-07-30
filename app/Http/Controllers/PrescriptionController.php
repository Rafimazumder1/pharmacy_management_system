<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CrudeRepository;
use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\Test;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $collection  = Prescription::latest()
            ->when($request->field && $request->keyword, function ($query) use ($request) {
                $query->where($request->field, 'LIKE', "%$request->keyword%");
            })->paginate($request->input('limit',10));
        return view('prescription.index', compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['medicines']   = Medicine::select('id','name','generic_name')->get();
        $data['tests']   = Test::select('id','name','center')->get();
        $data['patients']   = Patient::select('id','name')->get();
        $data['doctors']    = Doctor::select('id','name')->get();
        return view('prescription.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);
        try {
            $medicines = [];
            $medicineIds = $request->input('medicine');
            $schedules = $request->input('schedule');
            $day = $request->input('day');
            foreach ($medicineIds as $key => $medicine) {
                $medicines[] = [
                    'medicine' => $medicine,
                    'schedule' => $schedules[$key],
                    'day' => $day[$key]
                ];
            }
            $tests = array_map(function ($item) {
                return ['test' => $item];
            }, $request->input('test'));

            $data = [
                'prescription_no' => uniqid(),
                'visit_no' => $request->input('visit_no'),
                'patient_id' => $request->input('patient_id'),
                'tests' => json_encode($tests),
                'medicines' => json_encode($medicines),
                'date' => date('Y-m-d'),
                'referred_to' => $request->input('referred_to'),
                'visit_fees' => $request->input('visit_fees'),
                'description' => $request->input('description'),
                'advice' => $request->input('advice'),
            ];
            Prescription::create($data);
            return redirect()->route('prescription.index')->with('success','Prescription created successfully!');
        }catch (\Exception $e) {
            return redirect()->back()->with('error','Something went wrong');
        }
    }


    public function show(Prescription $prescription)
    {
        return view('prescription.show', compact('prescription'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prescription $prescription)
    {
        return view('prescription.edit', compact('prescription'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prescription $prescription)
    {
        $this->validation($request, $prescription->id);
        $data = $request->except('_token','_method');
        $tests = $request->input('test_id');
        $medicines = $request->input('medicine_id');
        $schedules = $request->input('schedule');
        dd(array_merge($medicines,$schedules));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prescription $prescription)
    {
        try {
            $prescription->delete();
            return redirect()->route('prescription.index')->with('success', 'Successfully deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    private function validation($request, $id = null)
    {
        return  $request->validate([
            'visit_no' => 'required',
            'patient_id' => 'required',
            'referred_to' => 'required',
            'visit_fees' => 'required',
        ]);
    }
}
