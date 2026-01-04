<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClubController extends Controller
{
    public function index()
    {
        $clubs = Club::orderBy('sort_order')->orderBy('id','desc')->get();
        return view('admin.clubs.index', compact('clubs'));
    }

    public function create()
    {
        return view('admin.clubs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_ur'     => ['required','string','max:255'],
            'sort_order'  => ['nullable','integer','min:0'],
            'is_featured' => ['nullable'],
        ]);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['sort_order']  = $data['sort_order'] ?? 0;

        Club::create($data);

        return redirect()->route('admin.clubs.index')->with('success', 'Club created successfully.');
    }

    public function edit(Club $club)
    {
        return view('admin.clubs.edit', compact('club'));
    }

    public function update(Request $request, Club $club)
    {
        $data = $request->validate([
            'name_ur'     => ['required','string','max:255'],
            'is_featured' => ['nullable'],
            'sort_order'  => ['nullable','integer','min:0'],
        ]);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['sort_order']  = $data['sort_order'] ?? 0;

        $club->update($data);

        return redirect()->route('admin.clubs.index')->with('success', 'Club updated successfully.');
    }

    public function destroy(Club $club)
    {
        $club->delete();
        return redirect()->route('admin.clubs.index')->with('success', 'Club deleted successfully.');
    }

    // unused resource methods (optional)
    public function show(Club $club) { abort(404); }
}
