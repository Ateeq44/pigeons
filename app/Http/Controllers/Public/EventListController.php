<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventListController extends Controller
{
    public function index()
    {
        $events = Event::with('club')
            ->orderByDesc('start_date')
            ->orderByDesc('id')
            ->get();

        return view('public.events', compact('events'));
    }
}
