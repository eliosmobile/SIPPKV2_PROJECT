<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomRequest;

class SuratHistoryController extends Controller
{
    public function index()
    {
        // Ambil data surat yang telah dikirim oleh mahasiswa
        $surat = RoomRequest::where('user_id', auth()->id())->get();

        return view('surat.history', compact('surat'));
    }
}
