<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $primaryKey = 'id_siswa';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['id_siswa','nama','jenis_kelamin','alamat'];

    public function peminjaman()
    {
        return $this->hasMany(peminjaman::class);
    }
    public function kunjungan()
    {
        return $this->hasMany(kunjungan::class);
    }
}
