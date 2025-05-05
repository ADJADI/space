<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TechnologyController extends Controller
{

    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    public function create()
    {
        return view('admin.technologies.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'content' => 'required|string',
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
            $srcmPath = $request->file('srcm')->store('public/technologies');
            $data['srcm'] = Storage::url($srcmPath);
        }
        
        if ($request->hasFile('srct')) {
            $srctPath = $request->file('srct')->store('public/technologies');
            $data['srct'] = Storage::url($srctPath);
        }
        
        if ($request->hasFile('srcd')) {
            $srcdPath = $request->file('srcd')->store('public/technologies');
            $data['srcd'] = Storage::url($srcdPath);
        }

        Technology::create($data);

        return redirect()->route('admin.technologies.index')
            ->with('success', 'Technology created successfully.');
    }

    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    public function update(Request $request, Technology $technology)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'content' => 'required|string',
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
            if ($technology->srcm) {
                Storage::delete(str_replace('/storage', 'public', $technology->srcm));
            }
            
            $srcmPath = $request->file('srcm')->store('public/technologies');
            $data['srcm'] = Storage::url($srcmPath);
        }
        
        if ($request->hasFile('srct')) {
            // Delete old file if exists
            if ($technology->srct) {
                Storage::delete(str_replace('/storage', 'public', $technology->srct));
            }
            
            $srctPath = $request->file('srct')->store('public/technologies');
            $data['srct'] = Storage::url($srctPath);
        }
        
        if ($request->hasFile('srcd')) {
            // Delete old file if exists
            if ($technology->srcd) {
                Storage::delete(str_replace('/storage', 'public', $technology->srcd));
            }
            
            $srcdPath = $request->file('srcd')->store('public/technologies');
            $data['srcd'] = Storage::url($srcdPath);
        }

        $technology->update($data);

        return redirect()->route('admin.technologies.index')
            ->with('success', 'Technology updated successfully.');
    }

    public function destroy(Technology $technology)
    {
        if ($technology->srcm) {
            Storage::delete(str_replace('/storage', 'public', $technology->srcm));
        }
        
        if ($technology->srct) {
            Storage::delete(str_replace('/storage', 'public', $technology->srct));
        }
        
        if ($technology->srcd) {
            Storage::delete(str_replace('/storage', 'public', $technology->srcd));
        }
        
        $technology->delete();

        return redirect()->route('admin.technologies.index')
            ->with('success', 'Technology deleted successfully.');
    }
}
