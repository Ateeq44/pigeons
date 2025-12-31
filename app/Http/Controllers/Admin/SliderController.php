<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('sort_order')->latest()->paginate(20);
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'      => ['nullable','string','max:255'],
            'link_url'   => ['nullable','string','max:500'],
            'sort_order' => ['nullable','integer','min:0'],
            'is_active'  => ['nullable','boolean'],
            'image'      => ['required','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        // ✅ Upload to public/uploads/sliders
        $data['image_path'] = $this->uploadToPublic($request->file('image'), 'uploads/sliders');

        Slider::create($data);

        return redirect()->route('admin.sliders.index')->with('success','Slider created');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $data = $request->validate([
            'title'      => ['nullable','string','max:255'],
            'link_url'   => ['nullable','string','max:500'],
            'sort_order' => ['nullable','integer','min:0'],
            'is_active'  => ['nullable','boolean'],
            'image'      => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            // delete old
            if ($slider->image_path && File::exists(public_path($slider->image_path))) {
                File::delete(public_path($slider->image_path));
            }

            $data['image_path'] = $this->uploadToPublic($request->file('image'), 'uploads/sliders');
        }

        $slider->update($data);

        return back()->with('success','Slider updated');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image_path && File::exists(public_path($slider->image_path))) {
            File::delete(public_path($slider->image_path));
        }

        $slider->delete();
        return back()->with('success','Slider deleted');
    }

    private function uploadToPublic($file, string $relativeDir): string
    {
        $dir = public_path($relativeDir);
        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $name = time().'_'.Str::random(10).'.'.$file->getClientOriginalExtension();
        $file->move($dir, $name);

        return $relativeDir.'/'.$name; // ✅ saved in DB like: uploads/sliders/xxx.jpg
    }
}
