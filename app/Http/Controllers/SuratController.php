<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomRequest; // Gantilah dengan model yang sesuai
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    public function edit($id)
    {
        $surat = RoomRequest::findOrFail($id);
        return view('surat.edit', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_acara' => 'required|string|max:255',
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        $surat = RoomRequest::findOrFail($id);
        $surat->nama_acara = $request->nama_acara;
        // Tambahkan pengupdatean lainnya sesuai kebutuhan
        $surat->save();

        return redirect()->route('surat.history')->with('success', 'Surat berhasil diupdate.');
    }

    public function destroy($id)
    {
        $surat = RoomRequest::findOrFail($id);
        $surat->delete();

        return redirect()->route('surat.history')->with('success', 'Surat berhasil dihapus.');
    }

    public function download($id)
    {
        $surat = RoomRequest::findOrFail($id);
        $filePath = storage_path('app/public/' . $surat->file_path);

        if (!file_exists($filePath)) {
            return redirect()->route('surat.history')->with('error', 'File tidak ditemukan.');
        }

        return response()->download($filePath);
    }
}
