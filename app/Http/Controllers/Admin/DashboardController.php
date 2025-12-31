<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Event;
use App\Models\Loft;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'clubs'  => Club::count(),
            'events' => Event::count(),
            'lofts'  => Loft::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
