<?php

namespace App\Http\Controllers;

use App\Models\Cluster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClusterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clusters = Cluster::all();

        return view('admin.cluster.index', compact('clusters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cluster.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'order' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cluster = new Cluster();
        $cluster->title = $request->title;
        $cluster->order = $request->order;
        $cluster->save();

        return redirect()->route("admin.data_cluster")->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cluster $cluster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cluster = Cluster::find($id);

        return view('admin.cluster.edit', compact('cluster'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'title' => 'required|string',
            'order' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cluster = Cluster::find($request->id);
        $cluster->title = $request->title;
        $cluster->order = $request->order;
        $cluster->save();

        return redirect()->route("admin.data_cluster")->with('success', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Cluster::destroy($id);

        return redirect()->route("admin.data_cluster")->with('warning', 'Berhasil menghapus data');
    }
}
