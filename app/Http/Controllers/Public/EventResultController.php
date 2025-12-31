<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class EventResultController extends Controller
{
    public function show(Event $event)
    {
        $event->load('club');
        $days = $event->days()->orderBy('day_date')->get();

        // participants
        $participants = DB::table('event_lofts')
            ->join('lofts', 'lofts.id', '=', 'event_lofts.loft_id')
            ->where('event_lofts.event_id', $event->id)
            ->select(
                'lofts.id as loft_id',
                'lofts.name_ur',
                'lofts.city_ur',
                'lofts.photo_path',
                'event_lofts.pigeons_total',
                'event_lofts.prize_amount'
            )
            ->orderBy('event_lofts.sort_order')
            ->orderBy('event_lofts.id')
            ->get();

        // totals per loft per day (duration sum)
        $totals = DB::table('arrivals')
            ->join('event_days', 'event_days.id', '=', 'arrivals.event_day_id')
            ->where('event_days.event_id', $event->id)
            ->whereNotNull('arrivals.duration_seconds')
            ->groupBy('arrivals.loft_id', 'arrivals.event_day_id')
            ->selectRaw('arrivals.loft_id, arrivals.event_day_id, SUM(arrivals.duration_seconds) as total_seconds')
            ->get();

        $map = [];
        foreach ($totals as $t) {
            $map[$t->loft_id][$t->event_day_id] = (int)$t->total_seconds;
        }

        // build rows (date-wise + grand)
        $rows = collect($participants)->map(function ($p) use ($days, $map) {
            $grand = 0;
            $dayValues = [];

            foreach ($days as $d) {
                $sec = $map[$p->loft_id][$d->id] ?? 0;
                $grand += $sec;

                $dayValues[$d->id] = [
                    'seconds' => $sec,
                    'hms' => $sec > 0 ? $this->secondsToHms($sec) : '',
                ];
            }

            return (object)[
                'loft_id' => $p->loft_id,
                'name_ur' => $p->name_ur,
                'city_ur' => $p->city_ur,
                'photo_path' => $p->photo_path,
                'pigeons_total' => $p->pigeons_total,
                'prize_amount' => $p->prize_amount,
                'days' => $dayValues,
                'grand_seconds' => $grand,
                'grand_hms' => $grand > 0 ? $this->secondsToHms($grand) : '',
            ];
        })
        ->sortByDesc('grand_seconds')
        ->values()
        ->map(function ($r, $idx) {
            $r->position = $idx + 1;
            return $r;
        });

        return view('public.event', compact('event','days','rows'));
    }

    private function secondsToHms(int $seconds): string
    {
        $h = intdiv($seconds, 3600);
        $m = intdiv($seconds % 3600, 60);
        $s = $seconds % 60;
        return sprintf('%02d:%02d:%02d', $h, $m, $s);
    }
}
