@extends('layout')

@section('cabecalho')
    Temporadas de {{$serie->nome}}
@endsection

@section('conteudo')

    @if($serie->capa)
    <div class="row mb-3">
        <div class="col-md-12 text-center">
            <a href="{{$serie->capa_url}}" target="_blank">
                <img src="{{$serie->capa_url}}" alt="Sem imagem" class="img-thumbnail" height="200px" width="200px" />
            </a>
        </div>
    </div>
    @endif
    <ul class="list-group">
        @foreach ($temporadas as $temporada)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="/temporadas/{{$temporada->id}}/episodios">Temporada {{ $temporada->numero }}</a>
                <span class="badge badge-secondary">
                    {{$temporada->getEpisodioAssistidos()->count()}} / {{$temporada->episodios->count()}}
                </span>
            </li>
        @endforeach
    </ul>
@endsection
