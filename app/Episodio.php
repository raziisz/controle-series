<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{
    protected $fillable = ['id', 'numero', 'temporada_id'];
    public $timestamps = false;
    public $incrementing = false;

    public function temporada()
    {

        return $this->belongsTo(Temporada::class);
    }
}
