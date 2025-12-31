<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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
            'sort_order' => ['nullable','integer','min:0'],
            'photo'      => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $this->uploadToPublic($request->file('photo'), 'uploads/lofts');
        }

        Loft::create($data);

        return redirect()->route('admin.lofts.index')->with('success','Loft created');
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
            'sort_order' => ['nullable','integer','min:0'],
            'photo'      => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ]);

        if ($request->hasFile('photo')) {

        // ✅ old file delete (only if exists in public)
            if ($loft->photo_path && File::exists(public_path($loft->photo_path))) {
                File::delete(public_path($loft->photo_path));
            }

            $data['photo_path'] = $this->uploadToPublic($request->file('photo'), 'uploads/lofts');
        }

        $loft->update($data);

        return back()->with('success','Loft updated');
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


    private function uploadToPublic($file, string $relativeDir): string
    {
        $dir = public_path($relativeDir);
        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $name = time().'_'.Str::random(10).'.'.$file->getClientOriginalExtension();
        $file->move($dir, $name);

    return $relativeDir.'/'.$name; // ✅ uploads/lofts/xxx.jpg
}
}