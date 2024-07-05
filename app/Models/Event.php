<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'nama_acara', 'nama_organisasi', 'tanggal_mulai', 'tanggal_selesai', 'room_id',
    ];
}
