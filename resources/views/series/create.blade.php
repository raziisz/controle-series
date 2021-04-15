@extends('layout')
@section('cabecalho')
    Adicionar Série
@endsection

@section('conteudo')
    @include('erros', ['errors' => $errors])
    <form method="post">
        @csrf
        <div class="row">
            <div class="col col-8">
                <label for="nome" class="">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control">
            </div>
            <div class="col col-2">
                <label for="qtd_temporadas" class="">Nº de temporadas</label>
                <input type="number" name="qtd_temporadas" id="qtd_temporadas" class="form-control">
            </div>
            <div class="col col-2">
                <label for="ep_por_temporada" class="">Ep. por temporadas</label>
                <input type="number" name="ep_por_temporada" id="ep_por_temporada" class="form-control">
            </div>
        </div>

        <button class="btn btn-primary mt-2">Adicionar</button>
    </form>
@endsection
