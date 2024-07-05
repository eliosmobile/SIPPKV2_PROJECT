<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomRequest;
use App\Models\FacilityRequest;

class FasilitasRequestController extends Controller
{
    public function create()
    {
        // Cek apakah mahasiswa memiliki surat yang sudah di-submit
        $surat = RoomRequest::where('user_id', auth()->id())
                            ->where('status', 'approved by direktur') // Pastikan surat sudah di-acc
                            ->exists();

        if (!$surat) {
            return redirect()->back()->with('error', 'Anda harus menyelesaikan proses pengajuan surat terlebih dahulu.');
        }

        // Tampilkan form untuk request peminjaman fasilitas
        return view('fasilitas.request');
    }

    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'nama_organisasi' => 'required|string',
            'nomor_kop_surat' => 'required|string',
            'nama_acara' => 'required|string',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
            'file_surat' => 'required|file|mimes:pdf|max:2048', // Contoh validasi untuk file PDF
        ]);

        // Simpan request peminjaman fasilitas
        $request->user()->facilityRequests()->create([
            'nama_organisasi' => $request->nama_organisasi,
            'nomor_kop_surat' => $request->nomor_kop_surat,
            'nama_acara' => $request->nama_acara,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            // Simpan file surat di storage
            'file_surat' => $request->file('file_surat')->store('surat', 'public'),
        ]);

        return redirect()->route('dashboard')->with('success', 'Permintaan peminjaman fasilitas berhasil dikirim.');
    }
}
