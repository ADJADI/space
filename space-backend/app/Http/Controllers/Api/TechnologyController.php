<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    /**
     * Display a listing of all technologies.
     */
    public function index()
    {
        $technologies = Technology::all();
        return response()->json($technologies);
    }

    /**
     * Display the specified technology.
     */
    public function show($id)
    {
        $technology = Technology::findOrFail($id);
        return response()->json($technology);
    }
}
