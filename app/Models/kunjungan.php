<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kunjungan extends Model
{
    use HasFactory;

    protected $table = 'kunjungan';

    protected $primaryKey = 'id_kunjungan';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['id_kunjungan', 'siswa_ku','guru_ku','kelas', 'tujuan', 'buku', 'keterangan'];

    public function siswa()
    {
    return $this->belongsTo(siswa::class, 'siswa_ku','id_siswa');
    }
    public function guru()
    {
    return $this->belongsTo(guru::class, 'guru_ku','id_guru');
    }
    public function buku()
    {
    return $this->belongsTo(buku::class, 'buku_ku','id_buku');
    }
}
