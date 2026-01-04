<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('club')
            ->orderByDesc('start_date')
            ->orderByDesc('id')
            ->get();

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $clubs = Club::orderBy('sort_order')->orderBy('name_ur')->get();
        return view('admin.events.create', compact('clubs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'club_id' => ['required','exists:clubs,id'],
            'title_ur' => ['required','string','max:255'],
            'start_time' => ['required','date_format:H:i'],
            'start_date' => ['required','date'],
            'end_date'   => ['required','date','after_or_equal:start_date'],
            'pigeons_per_loft' => ['required','integer','min:1','max:10'],
            'is_featured' => ['nullable'],
            'sort_order' => ['nullable','integer','min:0'],
        ]);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        

        Event::create($data);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        $clubs = Club::orderBy('sort_order')->orderBy('name_ur')->get();
        return view('admin.events.edit', compact('event','clubs'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'club_id' => ['required','exists:clubs,id'],
            'title_ur' => ['required','string','max:255'],
            'start_time' => ['required','date_format:H:i'],
            'start_date' => ['required','date'],
            'end_date'   => ['required','date','after_or_equal:start_date'],
            'pigeons_per_loft' => ['required','integer','min:1','max:10'],
            'is_featured' => ['nullable'],
            'sort_order' => ['nullable','integer','min:0'],
        ]);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $event->update($data);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }

    public function show(Event $event) { abort(404); }
}
