<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CrewMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CrewMemberController extends Controller
{

    public function index()
    {
        $crewMembers = CrewMember::all();
        return view('admin.crew.index', compact('crewMembers'));
    }


    public function create()
    {
        return view('admin.crew.create');
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
        
        if ($request->hasFile('srcm')) {
            $srcmPath = $request->file('srcm')->store('public/crew');
            $data['srcm'] = Storage::url($srcmPath);
        }
        
        if ($request->hasFile('srct')) {
            $srctPath = $request->file('srct')->store('public/crew');
            $data['srct'] = Storage::url($srctPath);
        }
        
        if ($request->hasFile('srcd')) {
            $srcdPath = $request->file('srcd')->store('public/crew');
            $data['srcd'] = Storage::url($srcdPath);
        }

        CrewMember::create($data);

        return redirect()->route('admin.crew.index')
            ->with('success', 'Crew member created successfully.');
    }


    public function show(CrewMember $crew)
    {
        return view('admin.crew.show', compact('crew'));
    }


    public function edit(CrewMember $crew)
    {
        return view('admin.crew.edit', compact('crew'));
    }


    public function update(Request $request, CrewMember $crew)
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
        
        if ($request->hasFile('srcm')) {
            if ($crew->srcm) {
                Storage::delete(str_replace('/storage', 'public', $crew->srcm));
            }
            
            $srcmPath = $request->file('srcm')->store('public/crew');
            $data['srcm'] = Storage::url($srcmPath);
        }
        
        if ($request->hasFile('srct')) {
            if ($crew->srct) {
                Storage::delete(str_replace('/storage', 'public', $crew->srct));
            }
            
            $srctPath = $request->file('srct')->store('public/crew');
            $data['srct'] = Storage::url($srctPath);
        }
        
        if ($request->hasFile('srcd')) {
            if ($crew->srcd) {
                Storage::delete(str_replace('/storage', 'public', $crew->srcd));
            }
            
            $srcdPath = $request->file('srcd')->store('public/crew');
            $data['srcd'] = Storage::url($srcdPath);
        }

        $crew->update($data);

        return redirect()->route('admin.crew.index')
            ->with('success', 'Crew member updated successfully.');
    }


    public function destroy(CrewMember $crew)
    {
        if ($crew->srcm) {
            Storage::delete(str_replace('/storage', 'public', $crew->srcm));
        }
        
        if ($crew->srct) {
            Storage::delete(str_replace('/storage', 'public', $crew->srct));
        }
        
        if ($crew->srcd) {
            Storage::delete(str_replace('/storage', 'public', $crew->srcd));
        }
        
        $crew->delete();

        return redirect()->route('admin.crew.index')
            ->with('success', 'Crew member deleted successfully.');
    }
}
