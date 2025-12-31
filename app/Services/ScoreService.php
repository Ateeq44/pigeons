<?php

namespace App\Services;

use Carbon\Carbon;

class ScoreService
{
    public static function durationSeconds(string $startTime, ?string $arrivalTime): ?int
    {
        if (!$arrivalTime) return null;

        $start = Carbon::createFromTimeString($startTime);
        $arr   = Carbon::createFromTimeString($arrivalTime);

        // If arrival next day (arrival < start), add 1 day
        if ($arr->lt($start)) {
            $arr->addDay();
        }

        return $start->diffInSeconds($arr);
    }
}
