<?php
namespace App\Http\Controllers;

use App\Models\RoomRequest;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomRequestController extends Controller
{
    public function index()
    {
        $surat = RoomRequest::where('user_id', Auth::id())->get();

        return view('surat.status-surat', compact('surat'));
    }

    public function create()
    {
        $rooms = Room::all();
        return view('room_requests.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_organisasi' => 'required|string|max:255',
            'nomor_surat' => 'required|string|max:255',
            'nama_acara' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'surat' => 'required|file|mimes:pdf|max:2048',
            'room_id' => 'required|exists:rooms,id', // Validasi untuk memastikan room_id harus diisi dan valid
        ]);

        $filePath = $request->file('surat')->store('surat', 'public');

        RoomRequest::create([
            'user_id' => Auth::id(),
            'nama_organisasi' => $request->nama_organisasi,
            'nomor_surat' => $request->nomor_surat,
            'nama_acara' => $request->nama_acara,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'surat' => $filePath,
            'room_id' => $request->room_id, // Menyimpan room_id
            'status' => 'pending',
        ]);

        return redirect()->route('room_requests.index')->with('success', 'Request submitted successfully.');
    }

    public function show($id)
    {
        $roomRequest = RoomRequest::findOrFail($id);
        return view('room_requests.show', compact('roomRequest'));
    }
}
