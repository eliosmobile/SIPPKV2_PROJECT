<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function fetchEvents(Request $request)
    {
        $room_id = $request->input('room_id');
        
        if ($room_id == 'all') {
            $events = Event::all();
        } else {
            $events = Event::where('room_id', $room_id)->get();
        }

        $eventsArray = [];
        foreach ($events as $event) {
            $eventsArray[] = [
                'title' => $event->nama_acara,
                'start' => $event->tanggal_mulai,
                'end' => $event->tanggal_selesai,
                'nama_organisasi' => $event->nama_organisasi,
                'room' => [
                    'id' => $event->room_id,
                    'name' => $event->room->name
                ]
            ];
        }

        return response()->json($eventsArray);
    }
}
