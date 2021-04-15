<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntrarController extends Controller
{
    public function index()
    {
        return view('entrar.index');
    }

    public function entrar(Request $request)
    {
        $authenticated = Auth::attempt($request->only(['email', 'password']));

        if(!$authenticated) {
            return redirect()->back()->withErrors('Usuário e/ou senha incorretas');
        }

        return redirect()->route('listar_series');
    }
}
