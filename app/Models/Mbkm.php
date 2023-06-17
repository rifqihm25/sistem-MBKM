<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mbkm extends Model
{
    use HasFactory;

    protected $primaryKey = 'mbkm_id';
    protected $table = 'mbkms';
    protected $guarded = [];

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'mbkm_id', 'mbkm_id');
    }
}
