<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\siswa;
use App\Models\guru;
use App\Models\buku;
use App\Models\dtl_peminjaman;

class peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $primaryKey = 'id_peminjaman';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['id_peminjaman', 'siswa_id','guru_id','kelas', 'tgl_pinjam', 'tgl_kembali', 'keterangan', 'tipe', 'status'];

    public function siswa()
    {
    return $this->belongsTo(siswa::class, 'siswa_id','id_siswa');
    }
    public function guru()
    {
    return $this->belongsTo(guru::class, 'guru_id','id_guru');
    }
    public function buku()
    {
    return $this->belongsTo(buku::class, 'buku_id');
    }

    public function details()
    {
    return $this->hasMany(dtl_peminjaman::class, 'peminjaman_id', 'id_peminjaman');
    }
}
