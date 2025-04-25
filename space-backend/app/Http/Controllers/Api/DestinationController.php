<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * Display a listing of all destinations.
     */
    public function index()
    {
        $destinations = Destination::all();
        return response()->json($destinations);
    }

    /**
     * Display the specified destination.
     */
    public function show($id)
    {
        $destination = Destination::findOrFail($id);
        return response()->json($destination);
    }
}
