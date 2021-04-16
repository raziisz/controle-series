<?php

namespace App\Listeners;

use App\Events\NovaSerie;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnviarEmailNovaSerieCadastrada implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NovaSerie  $event
     * @return void
     */
    public function handle(NovaSerie $event)
    {
        $nomeSerie = $event->nome;
        $qtdTemporadas = $event->qtdTemporadas;
        $qtdEpisodios = $event->qtdEpisodios;

        $users = User::all();

        foreach ($users as $i => $user) {
            $multiplicador = $i + 1;
            $email = new \App\Mail\NovaSerie($nomeSerie, $qtdTemporadas, $qtdEpisodios);
            $email-> subject = 'Nova Série Adicionada!';
            $when = now()->addSecond(5 * $multiplicador);
            \Illuminate\Support\Facades\Mail::to($user)->later($when, $email);
        }
    }
}
