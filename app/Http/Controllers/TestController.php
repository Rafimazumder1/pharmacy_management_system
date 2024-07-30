<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $collection = Test::query()
            ->when($request->field && $request->keyword, function ($query) use ($request) {
                $query->where($request->field, 'LIKE', "%$request->keyword%");
            })->paginate($request->input('limit',10));
        return view('test.index', compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('test.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);
        try {
            $data = $request->except('_token');
            Test::create($data);
            return redirect()->route('test.index')->with('success', 'Successfully created');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Test $test)
    {
        return view('test.edit', compact('test'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Test $test)
    {
        $this->validation($request, $test->id);
        try {
            $data = $request->except('_token','_method');
            $test->update($data);
            return redirect()->route('test.index')->with('success', 'Successfully updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test)
    {
        try {
            $test->delete();
            return redirect()->route('test.index')->with('success', 'Successfully deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    private function validation($request, $id = null)
    {
        return  $request->validate([
            'name' => 'required',
        ]);
    }
}
