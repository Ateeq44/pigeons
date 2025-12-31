<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventLoft;
use App\Models\Loft;
use Illuminate\Http\Request;

class EventLoftController extends Controller
{
    public function index(Event $event)
    {
        $participants = $event->participants()
            ->with('loft')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        // only show lofts not already attached
        $attachedIds = $participants->pluck('loft_id')->all();

        $availableLofts = Loft::when(count($attachedIds), function($q) use ($attachedIds){
                return $q->whereNotIn('id', $attachedIds);
            })
            ->orderBy('sort_order')
            ->orderBy('name_ur')
            ->get();

        return view('admin.event_lofts.index', compact('event','participants','availableLofts'));
    }

    public function attach(Request $request, Event $event)
    {
        $data = $request->validate([
            'loft_id' => ['required','exists:lofts,id'],
            'pigeons_total' => ['nullable','integer','min:1','max:255'],
            'prize_amount' => ['nullable','integer','min:0','max:999999999'],
            'sort_order' => ['nullable','integer','min:0'],
        ]);

        // prevent duplicate attach
        if (EventLoft::where('event_id', $event->id)->where('loft_id', $data['loft_id'])->exists()) {
            return back()->with('success', 'Already attached.');
        }

        EventLoft::create([
            'event_id' => $event->id,
            'loft_id' => $data['loft_id'],
            'pigeons_total' => $data['pigeons_total'] ?? null,
            'prize_amount' => $data['prize_amount'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.events.participants.index', $event)->with('success', 'Participant attached.');
    }

    public function destroy(Event $event, EventLoft $eventLoft)
    {
        if ($eventLoft->event_id !== $event->id) abort(404);

        $eventLoft->delete();

        return redirect()->route('admin.events.participants.index', $event)->with('success', 'Participant removed.');
    }
}
