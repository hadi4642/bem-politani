<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Anggota extends Authenticatable
{
    use HasFactory;

    protected $guarded = [];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}
