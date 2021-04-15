<?php

namespace App\Http\Controllers;


use App\{Temporada, Episodio};
use Illuminate\Http\Request;



class EpisodiosController extends Controller
{
    public function index(string $temporada, Request $request)
    {
        $mensagem = $request->session()->get('mensagem');
        $tempObj = Temporada::find($temporada);
        $episodios = $tempObj->episodios;
        $temporadaId = $tempObj->id;


        return view('episodios.index', compact('episodios', 'temporadaId', 'mensagem'));
    }

    public function assistir(string $temporada, Request $request)
    {
        $tempObj = Temporada::find($temporada);
        $episodiosAssistidos = $request->episodios;


        $tempObj->episodios->each(function (Episodio $episodio)
        use ($episodiosAssistidos)  {
            $episodio->assistido = in_array(
                $episodio->id,
                $episodiosAssistidos
            );
        });
        $tempObj->push();

        $request->session()->flash('mensagem', 'Episódios marcados como assistidos');

        return redirect()->back();
    }
}
