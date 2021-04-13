<?php


namespace App\Http\Controllers;


use App\Http\Requests\SeriesFormRequest;
use App\Serie;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

class SeriesController extends Controller
{
    public function index (Request $request) {

        $series = Serie::query()->orderBy('nome')->get();
        $mensagem = $request->session()->get('mensagem');

       return view('series.index', compact('series', 'mensagem'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        $nome = $request->nome;

        $id = Uuid::generate()->string;
        $serie = Serie::create([
            'nome' => $nome,
            'id' => $id
        ]);

        $qtdTemporadas = $request->qtd_temporadas;
        for ($i = 1; $i < $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create([ 'id' => Uuid::generate()->string, 'numero' => $i, 'serie_id' => $serie->id]);

            for ($j = 1; $j <= $request->ep_por_temporada; $j++) {
                $temporada->episodios()->create(['id' => Uuid::generate()->string, 'numero' => $j, 'temporada_id' => $temporada->id]);
            }
        }
        $request
            ->session()
            ->flash('mensagem', "Série {$serie->id} e suas temporadas e episódios criados com sucesso {$serie->nome}");

        return redirect()->route('listar_series');
    }

    public function destroy(Request $request)
    {
       Serie::destroy($request->id);

        $request
            ->session()
            ->flash('mensagem', "Série foi removida com sucesso");

        return redirect()->route('listar_series');
    }
}
