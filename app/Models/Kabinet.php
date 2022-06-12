<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabinet extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class);
    }
}
