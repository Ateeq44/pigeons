<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\EventDay;
use Illuminate\Support\Facades\DB;

class DayResultController extends Controller
{
    public function show(EventDay $day)
    {
        // Event + days for tabs
        $event = $day->event()->with('club')->firstOrFail();
        $days  = $event->days()->orderBy('day_date')->get();

        // Pigeon columns dynamic (1..10)
        $pigeonCount = $day->pigeonsCount();

        // Participants (lofts attached to event)
        $participants = DB::table('event_lofts')
            ->join('lofts', 'lofts.id', '=', 'event_lofts.loft_id')
            ->where('event_lofts.event_id', $event->id)
            ->select(
                'lofts.id as loft_id',
                'lofts.name_ur',
                'lofts.city_ur',
                'lofts.photo_path',
                'event_lofts.pigeons_total',
                'event_lofts.sort_order'
            )
            ->orderBy('event_lofts.sort_order')
            ->orderBy('event_lofts.id')
            ->get();

        // ✅ Arrivals durations for this day (we will show durations, not arrival_time)
        $arrivals = DB::table('arrivals')
            ->where('event_day_id', $day->id)
            ->select('loft_id', 'pigeon_no', 'duration_seconds')
            ->get();

        // Map: [loft_id][pigeon_no] = duration_seconds
        $map = [];
        foreach ($arrivals as $a) {
            $map[$a->loft_id][$a->pigeon_no] = (int)($a->duration_seconds ?? 0);
        }

        // Build rows: each loft => Pigeon1..N durations + total
        $rows = collect($participants)->map(function ($p) use ($pigeonCount, $map) {
            $totalSec = 0;
            $cols = [];

            for ($i = 1; $i <= $pigeonCount; $i++) {
                $sec = $map[$p->loft_id][$i] ?? 0;

                if ($sec > 0) {
                    $totalSec += $sec;
                    $cols[$i] = $this->secondsToHms($sec);
                } else {
                    $cols[$i] = '';
                }
            }

            return (object)[
                'loft_id' => $p->loft_id,
                'name_ur' => $p->name_ur,
                'city_ur' => $p->city_ur,
                'photo_path' => $p->photo_path,
                'pigeons_total' => $p->pigeons_total,
                'cols' => $cols,
                'total_seconds' => $totalSec,
                'total_hms' => $totalSec > 0 ? $this->secondsToHms($totalSec) : '',
            ];
        })
        // Rank by total (desc)
        ->sortByDesc('total_seconds')
        ->values()
        ->map(function ($r, $idx) {
            $r->position = $idx + 1;
            return $r;
        });

        // ===== Stats like reference =====
        $loftsCount = $participants->count();

        // total pigeons: use pigeons_total if provided, else 0 (same reference style)
        $totalPigeons = collect($participants)->sum(function ($p) {
            return (int)($p->pigeons_total ?? 0);
        });

        // landed pigeons: number of arrival records having duration_seconds > 0
        $landedCount = DB::table('arrivals')
            ->where('event_day_id', $day->id)
            ->whereNotNull('duration_seconds')
            ->where('duration_seconds', '>', 0)
            ->count();

        $remaining = max(0, $totalPigeons - $landedCount);

        $stats = [
            'lofts' => $loftsCount,
            'total_pigeons' => $totalPigeons,
            'landed' => $landedCount,
            'remaining' => $remaining,
        ];

        return view('public.day', compact(
            'event',
            'day',
            'days',
            'pigeonCount',
            'rows',
            'stats'
        ));
    }

    private function secondsToHms(int $seconds): string
    {
        // hours can exceed 24 (like your reference)
        $h = intdiv($seconds, 3600);
        $m = intdiv($seconds % 3600, 60);
        $s = $seconds % 60;
        return sprintf('%02d:%02d:%02d', $h, $m, $s);
    }
}
