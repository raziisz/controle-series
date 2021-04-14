<?php

namespace App\Http\Controllers;

use App\Serie;
use App\Temporada;
use Illuminate\Http\Request;

class TemporadasController extends Controller
{
    public function index(string $serieId)
    {

        $serie = Serie::find($serieId);
        $temporadas =  Temporada::query()->where('serie_id', $serieId)->get();

        return view('temporadas.index', compact('temporadas', 'serie'));
    }
}
