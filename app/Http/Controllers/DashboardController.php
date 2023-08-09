<?php

namespace App\Http\Controllers;

use App\Models\Stunting;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getDataStunting()
    {
        $stunting = Stunting::with('cluster')->get()->toArray();

        return response()->json($stunting);
    }

    public function index()
    {
        return view('admin.dashboard');
    }
}
