<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\buku;

class kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    
    protected $primaryKey = 'id_kat';

    protected $fillable = ['nama'];

    public function buku()
    {
        return $this->hasMany(buku::class);
    }
}
