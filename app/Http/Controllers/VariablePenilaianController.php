<?php

namespace App\Http\Controllers;

use App\Models\VariablePenilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VariablePenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $variable_penilaian = VariablePenilaian::all();
        return view('admin.variable_penilaian.index', compact('variable_penilaian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.variable_penilaian.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $variable_penilaian = new VariablePenilaian();
        $variable_penilaian->name = $request->name;
        $variable_penilaian->save();

        return redirect()->route("admin.variable_penilaian")->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(VariablePenilaian $variablePenilaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $variable_penilaian = VariablePenilaian::find($id);
        return view('admin.variable_penilaian.edit', compact('variable_penilaian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $variable_penilaian = VariablePenilaian::find($request->id);
        $variable_penilaian->name = $request->name;
        $variable_penilaian->save();

        return redirect()->route("admin.variable_penilaian")->with('success', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        VariablePenilaian::destroy($id);

        return redirect()->route("admin.variable_penilaian")->with('warning', 'Berhasil menghapus data');
    }
}
