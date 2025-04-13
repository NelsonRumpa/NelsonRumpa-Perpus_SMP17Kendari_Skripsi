<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\peminjaman;

class dtl_peminjaman extends Model
{
    use HasFactory;

    protected $table = 'dtl_peminjaman';

    protected $fillable = ['peminjaman_id', 'buku_id', 'jumlah','is_returned'];

    public function peminjaman()
    {
        return $this->belongsTo(peminjaman::class,'peminjaman_id','id_peminjaman');
    }

    public function buku()
    {
    return $this->belongsTo(buku::class, 'buku_id','id_buku');
    }
}
