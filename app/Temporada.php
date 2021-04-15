<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    protected $fillable = ['id', 'numero', 'serie_id'];
    public $timestamps = false;
    public $incrementing = false;
    public function episodios()
    {
        return $this->hasMany(Episodio::class);
    }

    public function serie()
    {
        $this->belongsTo(Serie::class);
    }

    public function getEpisodioAssistidos(): Collection
    {
        return $this->episodios->filter(function(Episodio $episodio) {
            return $episodio->assistido;
        });
    }
}
