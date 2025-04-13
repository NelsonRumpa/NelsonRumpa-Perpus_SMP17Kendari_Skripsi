<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\buku;

class rakbuku extends Model
{
    use HasFactory;

    protected $table = 'rakbuku';

    protected $primaryKey = 'id_rak';

    protected $fillable = ['lokasi'];

    public function buku()
    {
        return $this->hasMany(buku::class);
    }
    
}
