<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LoftController extends Controller
{
    public function index()
    {
        $lofts = Loft::orderBy('sort_order')->orderByDesc('id')->get();
        return view('admin.lofts.index', compact('lofts'));
    }

    public function create()
    {
        return view('admin.lofts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_ur'    => ['required','string','max:255'],
            'city_ur'    => ['nullable','string','max:255'],
            'photo'      => ['nullable','image','max:2048'],
            'sort_order' => ['nullable','integer','min:0'],
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('lofts', 'public');
        }

        Loft::create([
            'name_ur' => $data['name_ur'],
            'city_ur' => $data['city_ur'] ?? null,
            'photo_path' => $photoPath,
            'sort_order' => $data['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.lofts.index')->with('success', 'Loft created successfully.');
    }

    public function edit(Loft $loft)
    {
        return view('admin.lofts.edit', compact('loft'));
    }

    public function update(Request $request, Loft $loft)
    {
        $data = $request->validate([
            'name_ur'    => ['required','string','max:255'],
            'city_ur'    => ['nullable','string','max:255'],
            'photo'      => ['nullable','image','max:2048'],
            'sort_order' => ['nullable','integer','min:0'],
        ]);

        if ($request->hasFile('photo')) {
            // delete old
            if ($loft->photo_path) {
                Storage::disk('public')->delete($loft->photo_path);
            }
            $loft->photo_path = $request->file('photo')->store('lofts', 'public');
        }

        $loft->name_ur = $data['name_ur'];
        $loft->city_ur = $data['city_ur'] ?? null;
        $loft->sort_order = $data['sort_order'] ?? 0;

        $loft->save();

        return redirect()->route('admin.lofts.index')->with('success', 'Loft updated successfully.');
    }

    public function destroy(Loft $loft)
    {
        if ($loft->photo_path) {
            Storage::disk('public')->delete($loft->photo_path);
        }
        $loft->delete();

        return redirect()->route('admin.lofts.index')->with('success', 'Loft deleted successfully.');
    }

    public function show(Loft $loft) { abort(404); }
}
