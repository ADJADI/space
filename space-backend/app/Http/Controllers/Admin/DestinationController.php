<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $destinations = Destination::all();
        return view('admin.destinations.index', compact('destinations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.destinations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'km' => 'required|string|max:255',
            'days' => 'required|string|max:255',
            'srcm' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'srct' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'srcd' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alt' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        
        // Handle file uploads
        if ($request->hasFile('srcm')) {
            $srcmPath = $request->file('srcm')->store('public/destinations');
            $data['srcm'] = Storage::url($srcmPath);
        }
        
        if ($request->hasFile('srct')) {
            $srctPath = $request->file('srct')->store('public/destinations');
            $data['srct'] = Storage::url($srctPath);
        }
        
        if ($request->hasFile('srcd')) {
            $srcdPath = $request->file('srcd')->store('public/destinations');
            $data['srcd'] = Storage::url($srcdPath);
        }

        Destination::create($data);

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Destination $destination)
    {
        return view('admin.destinations.show', compact('destination'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destination $destination)
    {
        return view('admin.destinations.edit', compact('destination'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Destination $destination)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'km' => 'required|string|max:255',
            'days' => 'required|string|max:255',
            'srcm' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'srct' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'srcd' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alt' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except(['srcm', 'srct', 'srcd']);
        
        // Handle file uploads
        if ($request->hasFile('srcm')) {
            // Delete old file if exists
            if ($destination->srcm) {
                Storage::delete(str_replace('/storage', 'public', $destination->srcm));
            }
            
            $srcmPath = $request->file('srcm')->store('public/destinations');
            $data['srcm'] = Storage::url($srcmPath);
        }
        
        if ($request->hasFile('srct')) {
            // Delete old file if exists
            if ($destination->srct) {
                Storage::delete(str_replace('/storage', 'public', $destination->srct));
            }
            
            $srctPath = $request->file('srct')->store('public/destinations');
            $data['srct'] = Storage::url($srctPath);
        }
        
        if ($request->hasFile('srcd')) {
            // Delete old file if exists
            if ($destination->srcd) {
                Storage::delete(str_replace('/storage', 'public', $destination->srcd));
            }
            
            $srcdPath = $request->file('srcd')->store('public/destinations');
            $data['srcd'] = Storage::url($srcdPath);
        }

        $destination->update($data);

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        // Delete associated images
        if ($destination->srcm) {
            Storage::delete(str_replace('/storage', 'public', $destination->srcm));
        }
        
        if ($destination->srct) {
            Storage::delete(str_replace('/storage', 'public', $destination->srct));
        }
        
        if ($destination->srcd) {
            Storage::delete(str_replace('/storage', 'public', $destination->srcd));
        }
        
        $destination->delete();

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination deleted successfully.');
    }
}
