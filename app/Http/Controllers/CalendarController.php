<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Event;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('calender', compact('rooms'));
    }

    public function fetchEvents(Request $request)
    {
        $room_id = $request->room_id;
        $events = $room_id === 'all' ? Event::all() : Event::where('room_id', $room_id)->get();

        return response()->json($events);
    }
}
