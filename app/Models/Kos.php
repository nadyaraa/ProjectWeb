<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'tipe',
        'lokasi',
        'harga',
        'jumlah_kamar',
        'status',
        'deskripsi',
        'foto',
    ];

    // Relasi ke User (pemilik kos)
    public function pemilik()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
