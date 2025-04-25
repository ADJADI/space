<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CrewMember;
use App\Models\Destination;
use App\Models\Technology;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view.
     */
    public function index()
    {
        $statistics = [
            'destinations' => Destination::count(),
            'crew_members' => CrewMember::count(),
            'technologies' => Technology::count(),
        ];

        return view('admin.dashboard.index', compact('statistics'));
    }
}
