<?php

namespace App\Http\Controllers;

use App\Models\Stunting;
use App\Http\Requests\StoreStuntingRequest;
use App\Http\Requests\UpdateStuntingRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StuntingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stunting = Stunting::all();
        return view('admin.stunting.index', compact('stunting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stunting.create');
    }

    private function uploadFile($file, $dest, $filename): string
    {
        $extention = $file->getClientOriginalExtension();
        $filename = ($filename != "" ? $filename : Carbon::now()->timestamp) . '.' . $extention;
        $file->move($dest, $filename);

        return $filename;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required|string",
            'jumlah_laki_laki' => "required|integer",
            'jumlah_prempuan' => "required|integer",
            'lat' => "required",
            'long' => "required",
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // $file_geojson = "";
        // $file_geojson = $this->uploadFile($request->file('file_geojson'), public_path('assets/geojson/'), $request->name . '-' . Carbon::now()->timestamp);

        $stunting = new Stunting();
        $stunting->name = $request->name;
        $stunting->jumlah_laki_laki = $request->jumlah_laki_laki;
        $stunting->jumlah_prempuan = $request->jumlah_prempuan;
        $stunting->long = $request->long;
        $stunting->lat = $request->lat;
        $stunting->save();

        return redirect()->route("admin.stunting")->with('success', 'Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stunting $stunting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $stunting = Stunting::find($id);

        return view('admin.stunting.edit', compact('stunting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required|string",
            'jumlah_laki_laki' => "required|integer",
            'jumlah_prempuan' => "required|integer",
            'lat' => "required",
            'long' => "required",
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $stunting = Stunting::find($request->id);
        $stunting->name = $request->name;
        $stunting->jumlah_laki_laki = $request->jumlah_laki_laki;
        $stunting->jumlah_prempuan = $request->jumlah_prempuan;
        $stunting->long = $request->long;
        $stunting->lat = $request->lat;
        $stunting->save();

        return redirect()->route("admin.stunting")->with('success', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Stunting::destroy($id);

        return redirect()->route("admin.stunting")->with('warning', 'Berhasil menghapus data');
    }
}
