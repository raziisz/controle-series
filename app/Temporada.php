<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    public function episodios()
    {
        return $this->hasMany(Episodio::class);
    }

    public function serie()
    {
        $this->belongsTo(Serie::class);
    }
    public $incrementing = false;
}
