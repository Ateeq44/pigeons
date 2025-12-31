<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Arrival;
use App\Models\Event;
use App\Models\EventDay;
use App\Services\ScoreService;
use Illuminate\Http\Request;

class ArrivalController extends Controller
{
    public function edit(Event $event, EventDay $day)
    {
        // ensure day belongs to event
        if ($day->event_id !== $event->id) abort(404);

        $count = $day->pigeonsCount(); // 1..10 dynamic

        $participants = $event->participants()
            ->with('loft')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        // preload arrivals [loft_id][pigeon_no] => Arrival
        $arrivals = Arrival::where('event_day_id', $day->id)
            ->get()
            ->groupBy('loft_id')
            ->map(fn($rows) => $rows->keyBy('pigeon_no'));

        return view('admin.arrivals.edit', compact('event','day','count','participants','arrivals'));
    }

    public function update(Request $request, Event $event, EventDay $day)
    {
        if ($day->event_id !== $event->id) abort(404);

        $count = $day->pigeonsCount();
        $startTime = $event->start_time; // H:i:s

        // Expect data: times[loft_id][pigeon_no] = "HH:MM" or ""
        $times = $request->input('times', []);

        foreach ($times as $loftId => $pigeonTimes) {
            for ($i = 1; $i <= $count; $i++) {
                $t = $pigeonTimes[$i] ?? null;
                $t = is_string($t) ? trim($t) : null;
                if ($t === '') $t = null;

                // validate time format if present (HH:MM)
                if ($t !== null && !preg_match('/^\d{2}:\d{2}$/', $t)) {
                    return back()->withErrors(["Invalid time format for loft {$loftId}, pigeon {$i}. Use HH:MM"]);
                }

                $duration = ScoreService::durationSeconds($startTime, $t ? $t.':00' : null);

                // if empty: delete record if exists (optional) OR keep null
                if ($t === null) {
                    Arrival::where('event_day_id', $day->id)
                        ->where('loft_id', $loftId)
                        ->where('pigeon_no', $i)
                        ->delete();
                    continue;
                }

                Arrival::updateOrCreate(
                    [
                        'event_day_id' => $day->id,
                        'loft_id' => $loftId,
                        'pigeon_no' => $i,
                    ],
                    [
                        'arrival_time' => $t.':00',
                        'duration_seconds' => $duration,
                    ]
                );
            }
        }

        return redirect()->route('admin.arrivals.edit', [$event, $day])
            ->with('success', 'Arrivals saved successfully.');
    }
}
