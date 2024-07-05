<?php
namespace App\Http\Controllers;

use App\Models\RoomRequest;
use App\Models\Room;
use App\Models\User; // Tambahkan impor untuk User
use Illuminate\Http\Request;

class WadirController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        $totalRequests = RoomRequest::count();
        $approvedRequests = RoomRequest::where('status', 'approved')->count();
        $pendingRequests = RoomRequest::where('status', 'pending')->count();
        $rejectedRequests = RoomRequest::where('status', 'rejected')->count();
        return view('wadir.index', compact('rooms', 'totalRequests', 'approvedRequests', 'pendingRequests', 'rejectedRequests'));
    }

    public function getEvents(Request $request)
    {
        $room_id = $request->input('room_id');
        $events = RoomRequest::where('approved_by_wadir', true)
            ->when($room_id, function ($query, $room_id) {
                return $query->where('room_id', $room_id);
            })
            ->get(['id', 'nama_acara as title', 'tanggal_mulai as start', 'tanggal_selesai as end']);

        return response('wadir.index')->json($events);
    }
    
    public function requests()
    {
        $requests = RoomRequest::where('approved_by_admin', true)->where('approved_by_wadir', false)->get();
        return view('wadir.requests', compact('requests'));
    }
    public function approveRequest($id)
    {
        $roomRequest = RoomRequest::findOrFail($id);
        $roomRequest->approved_by_wadir = true;
        $roomRequest->status = 'approved by wadir';
        $roomRequest->save();

        // Kirim notifikasi atau proses lanjutan ke role direktur
        $direkturs = User::role('direktur')->get();
        foreach ($direkturs as $direktur) {
            // Kirim notifikasi ke setiap direktur (Implementasi notifikasi bisa disesuaikan)
        }

        return redirect()->route('wadir.requests')->with('success', 'Request approved successfully and forwarded to Direktur.');
    }

    public function download($id)
    {
        $roomRequest = RoomRequest::findOrFail($id);
        return response()->download(storage_path('app/public/' . $roomRequest->surat));
    }

    public function approvedRequests()
    {
        $requests = RoomRequest::where('approved_by_wadir', true)->get();
        return view('wadir.approved_requests', compact('requests'));
    }

    public function deleteRequest($id)
    {
        $roomRequest = RoomRequest::findOrFail($id);
        $roomRequest->delete();

        return redirect()->route('wadir.index')->with('success', 'Request deleted successfully.');
    }
}
