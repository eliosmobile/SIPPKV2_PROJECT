<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $request_count = RoomRequest::where('user_id', Auth::id())->count();
        $rooms = Room::all();
        
        return view('dashboard_mahasiswa', compact('request_count', 'rooms'));
    }

    public function fetchEvents(Request $request)
    {
        $room_id = $request->get('room_id');

        $eventsQuery = RoomRequest::query();
        if ($room_id && $room_id !== 'all') {
            $eventsQuery->where('room_id', $room_id);
        }

        $events = $eventsQuery->get()->map(function ($request) {
            return [
                'title' => $request->event_name,
                'description' => $request->description,
                'start' => $request->event_start,
                'end' => $request->event_end,
            ];
        });

        return response()->json($events);
    }
}
