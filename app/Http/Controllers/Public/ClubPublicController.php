<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Club;

class ClubPublicController extends Controller
{
    public function index()
    {
        $clubs = Club::orderBy('sort_order')->orderBy('name_ur')->get();
        return view('public.clubs.index', compact('clubs'));
    }

    public function show(Club $club)
    {
        $events = $club->events()
            ->orderByDesc('start_date')
            ->orderByDesc('id')
            ->get();

        return view('public.clubs.show', compact('club','events'));
    }
}
