<?php

namespace App\Http\Controllers;

use App\Models\Network;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        $networks = Network::all();
        return view('map.index', compact('networks'));
    }
}
