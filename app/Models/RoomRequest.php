<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomRequest extends Model
{
    protected $fillable = [
        'user_id',
        'nama_organisasi',
        'nama_acara',
        'nomor_surat',
        'tanggal_mulai',
        'tanggal_selesai',
        'surat',
        'status',
        'room_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
