<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman_barangs';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detail_peminjaman()
    {
        return $this->hasMany(Detailpeminjaman::class, 'pinjambarang_id');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
}
