<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CrewMember;
use Illuminate\Http\Request;

class CrewMemberController extends Controller
{
    /**
     * Display a listing of all crew members.
     */
    public function index()
    {
        $crewMembers = CrewMember::all();
        return response()->json($crewMembers);
    }

    /**
     * Display the specified crew member.
     */
    public function show($id)
    {
        $crewMember = CrewMember::findOrFail($id);
        return response()->json($crewMember);
    }
}
