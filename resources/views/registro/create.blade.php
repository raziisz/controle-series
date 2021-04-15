@extends('layout')
@section('cabecalho')
    Registrar-se
@endsection

@section('conteudo')
    @include('erros', ['errors' => $errors])
    <form method="post">
        @csrf
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" required id="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" required id="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" name="password" required min="1" id="password" class="form-control">
        </div>

        <button class="btn btn-primary mt-3">
            Entrar
        </button>
    </form>
@endsection
