<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\peminjaman;
use App\Models\kunjungan;

class guru extends Model
{
    use HasFactory;

    protected $table = 'guru';

    protected $primaryKey = 'id_guru';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['id_guru','nama'];

    public function peminjaman()
    {
        return $this->hasMany(peminjaman::class);
    }
    public function kunjungan()
    {
        return $this->hasMany(kunjungan::class);
    }
}
