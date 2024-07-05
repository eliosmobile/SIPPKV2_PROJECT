<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    /**
     * Display the super admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // You can add logic here to fetch any necessary data for the dashboard
        return view('superadmin.dashboard');
    }

    /**
     * Show form to create a new super admin.
     *
     * @return \Illuminate\View\View
     */
    public function createSuperAdmin()
    {
        return view('superadmin.create_superadmin');
    }

    /**
     * Show form to create a new admin ruangan.
     *
     * @return \Illuminate\View\View
     */
    public function createAdminRuangan()
    {
        return view('superadmin.create_adminruangan');
    }

    /**
     * Show form to create a new admin fasilitas.
     *
     * @return \Illuminate\View\View
     */
    public function createAdminFasilitas()
    {
        return view('superadmin.create_adminfasilitas');
    }

    /**
     * Show form to create a new wadir.
     *
     * @return \Illuminate\View\View
     */
    public function createWadir()
    {
        return view('superadmin.create_wadir');
    }

    /**
     * Show form to create a new direktur.
     *
     * @return \Illuminate\View\View
     */
    public function createDirektur()
    {
        return view('superadmin.create_direktur');
    }

    /**
     * Show form to create a new mahasiswa.
     *
     * @return \Illuminate\View\View
     */
    public function createMahasiswa()
    {
        return view('superadmin.create_mahasiswa');
    }

    /**
     * Handle password change for any user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully.');
    }
}
