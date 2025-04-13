<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\kategori;
use App\Models\rakbuku;

class buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $primaryKey = 'id_buku';

    protected $fillable = ['judul','cover','kategori_id','rak_id','ISBN','jumlah','penulis','penerbit','tahun_terbit'];

    public function kategori()
    {
        return $this->belongsTo(kategori::class,'kategori_id');
    }

    public function rak()
    {
        return $this->belongsTo(rakbuku::class,'rak_id');
    }

    public function dtl_peminjaman()
    {
        return $this->hasMany(dtl_peminjaman::class, 'buku_id', 'id_buku');
    }

    public function peminjaman()
    {
        return $this->hasMany(peminjaman::class);
    }
    public function kunjungan()
    {
        return $this->hasMany(kunjungan::class);
    }
}
