<?php
namespace App\Http\Controllers;

use App\Models\RoomRequest;
use App\Models\Room;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;


class DirekturController extends Controller
{
    public function dashboard()
    {
        $incomingRequestsCount = RoomRequest::where('approved_by_wadir', true)->where('approved_by_direktur', false)->count();
        $processedRequestsCount = RoomRequest::where('approved_by_direktur', true)->count();
        $approvedRequestsCount = RoomRequest::where('approved_by_direktur', true)->count();
        $rooms = Room::all();
        $events = Event::all();

        return view('direktur.dashboard', compact('incomingRequestsCount', 'processedRequestsCount', 'approvedRequestsCount', 'rooms', 'events'));
    }

    public function getRoomEvents($roomId)
    {
        $events = Event::where('room_id', $roomId)->get();
        return response()->json($events);
    }

    public function completeRequests()
    {
        $requests = RoomRequest::where('approved_by_direktur', true)->get();
        return view('direktur.complete_requests', compact('requests'));
    }



    public function history()
    {
        $requests = RoomRequest::where('approved_by_wadir', true)->where('approved_by_direktur', false)->get();
        return view('direktur.history', compact('requests'));
    }
                                                                                                                                                                                                                                                                                                                                                                            
    public function approveRequest($id)
    {
        $roomRequest = RoomRequest::findOrFail($id);
        $roomRequest->approved_by_direktur = true;
        $roomRequest->status = 'approved by direktur';
        $roomRequest->save();

        // Add to events table
        Event::create([
            'nama_acara' => $roomRequest->nama_acara,
            'nama_organisasi' => $roomRequest->nama_organisasi,
            'tanggal_mulai' => $roomRequest->tanggal_mulai,
            'tanggal_selesai' => $roomRequest->tanggal_selesai,      
            'room_id' => $roomRequest->room_id,      
        ]);

        return redirect()->route('direktur.requests')->with('success', 'Request approved successfully and added to events.');
    }

    public function download($id)
    {
        $roomRequest = RoomRequest::findOrFail($id);
        return response()->download(storage_path('app/public/' . $roomRequest->letter_file_path));
    }
    public function destroy($id)
    {
        $roomRequest = RoomRequest::findOrFail($id);
        $roomRequest->delete();

        return redirect()->route('direktur.requests')->with('success', 'Request deleted successfully.');
    }

    public function requests()
    {
        $history = RoomRequest::where('approved_by_direktur', true)->get();
        return view('direktur.requests', compact('history'));
    }
}
