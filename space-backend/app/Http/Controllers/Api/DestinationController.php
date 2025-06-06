<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::all();
        return response()->json($destinations);
    }

    public function show($id)
    {
        $destination = Destination::findOrFail($id);
        return response()->json($destination);
    }
}
