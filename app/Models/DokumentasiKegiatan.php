<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumentasiKegiatan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}