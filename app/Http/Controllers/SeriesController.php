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
        $request
            ->session()
            ->flash('mensagem', "Série {$serie->id} criada com sucesso {$serie->nome}");

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
