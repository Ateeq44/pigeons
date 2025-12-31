<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventDay;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventDayController extends Controller
{
    public function index(Event $event)
    {
        $days = $event->days()->orderBy('day_date')->get();
        return view('admin.event_days.index', compact('event', 'days'));
    }

    public function generate(Request $request, Event $event)
    {
        // optional override for all days (leave empty to use event pigeons_per_loft)
        $data = $request->validate([
            'pigeons_per_loft' => ['nullable', 'integer', 'min:1', 'max:10'],
        ]);

        $start = Carbon::parse($event->start_date);
        $end   = Carbon::parse($event->end_date);

        $created = 0;

        for ($d = $start->copy(); $d->lte($end); $d->addDay()) {
            $day = EventDay::firstOrCreate(
                ['event_id' => $event->id, 'day_date' => $d->toDateString()],
                [
                    'pigeons_per_loft' => $data['pigeons_per_loft'] ?? null,
                    'sort_order' => 0,
                ]
            );

            if ($day->wasRecentlyCreated) $created++;
        }

        return redirect()
            ->route('admin.events.days.index', $event)
            ->with('success', "Days generated. New created: {$created}");
    }

    public function destroy(Event $event, EventDay $day)
    {
        // Safety: ensure this day belongs to this event
        if ($day->event_id !== $event->id) abort(404);

        $day->delete();

        return redirect()
            ->route('admin.events.days.index', $event)
            ->with('success', 'Day deleted successfully.');
    }
}
