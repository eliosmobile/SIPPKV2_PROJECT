<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomRequest;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminRuanganController extends Controller
{
    public function index()
    {
        $request_count = RoomRequest::count();
        $completed_requests = RoomRequest::where('status', 'completed')->count();
        $requests = RoomRequest::where('status', 'pending')->get();
        $rooms = Room::all();

        return view('admin_ruangan.dashboard', compact('request_count', 'completed_requests', 'requests', 'rooms'));
    }

    public function index_admin()
    {
        $admins = User::role('admin ruangan')->get();
        return view('admin_ruangan.index', compact('admins'));
    }

    public function edit($id)
    {
        $admin = User::findOrFail($id);
        return view('admin_ruangan.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        $admin->password = bcrypt($request->password);
        $admin->save();

        return redirect()->route('admin_ruangan.index')->with('success', 'Password updated successfully.');
    }

    public function destroy($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin_ruangan.index')->with('success', 'Admin account deleted successfully.');
    }

    public function requests()
    {
        $requests = RoomRequest::with('user', 'room')->where('approved_by_admin', false)->get();
        return view('admin_ruangan.requests', compact('requests'));
    }

    public function approveRequest($id)
    {
        $request = RoomRequest::findOrFail($id);
        $request->status = 'approved by admin';
        $request->approved_by_admin = true;
        $request->save();

        // Kirim notifikasi atau proses lanjutan ke role wadir
        $wadirs = User::role('wadir')->get();
        foreach ($wadirs as $wadir) {
            // Kirim notifikasi ke setiap wadir (Implementasi notifikasi bisa disesuaikan)
        }

        return redirect()->route('admin_ruangan.requests')->with('success', 'Request approved successfully and forwarded to Wadir.');
    }

    public function rejectRequest($id)
    {
        $request = RoomRequest::findOrFail($id);
        $request->status = 'rejected';
        $request->save();

        return redirect()->route('admin_ruangan.requests')->with('success', 'Request rejected successfully.');
    }

    public function downloadRequest($id)
    {
        $request = RoomRequest::findOrFail($id);
        return Storage::disk('public')->download($request->surat);
    }

    public function createRoom()
    {
        return view('admin_ruangan.create_room');
    }

    public function storeRoom(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Room::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin_ruangan.dashboard')->with('success', 'Room created successfully.');
    }

    public function createUser()
    {
        return view('admin_ruangan.create_user');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole('admin ruangan');

        return redirect()->route('admin_ruangan.dashboard')->with('success', 'Admin user created successfully.');
    }
}
