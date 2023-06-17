<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswas';
    protected $guarded = ['id'];

    public function konversi()
    {
        return $this->hasMany(Konversi::class);
    }

    public function mbkm()
    {
        return $this->belongsTo(Mbkm::class, 'mbkm_id', 'mbkm_id');
    }
}
