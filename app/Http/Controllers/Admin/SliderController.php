<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('sort_order')->orderByDesc('id')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['nullable','string','max:255'],
            'link_url' => ['nullable','string','max:500'],
            'sort_order' => ['nullable','integer','min:0'],
            'is_active' => ['nullable'],
            'image' => ['required','image','max:4096'],
        ]);

        $path = $request->file('image')->store('sliders', 'public');

        Slider::create([
            'title' => $data['title'] ?? null,
            'link_url' => $data['link_url'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
            'image_path' => $path,
        ]);

        return redirect()->route('admin.sliders.index')->with('success','Slider added');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $data = $request->validate([
            'title' => ['nullable','string','max:255'],
            'link_url' => ['nullable','string','max:500'],
            'sort_order' => ['nullable','integer','min:0'],
            'is_active' => ['nullable'],
            'image' => ['nullable','image','max:4096'],
        ]);

        if ($request->hasFile('image')) {
            if ($slider->image_path && Storage::disk('public')->exists($slider->image_path)) {
                Storage::disk('public')->delete($slider->image_path);
            }
            $slider->image_path = $request->file('image')->store('sliders', 'public');
        }

        $slider->title = $data['title'] ?? null;
        $slider->link_url = $data['link_url'] ?? null;
        $slider->sort_order = $data['sort_order'] ?? 0;
        $slider->is_active = $request->boolean('is_active');
        $slider->save();

        return redirect()->route('admin.sliders.index')->with('success','Slider updated');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image_path && Storage::disk('public')->exists($slider->image_path)) {
            Storage::disk('public')->delete($slider->image_path);
        }
        $slider->delete();
        return back()->with('success','Slider deleted');
    }
}
