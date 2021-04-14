<?php


namespace App\Services;


use App\Serie;
use Webpatser\Uuid\Uuid;

class CriadorDeSerie
{
    public function criarSerie(
        string $nomeSerie,
        int $qtdTemporadas,
        int $epPorTemporada
    ): Serie
    {

        $id = Uuid::generate()->string;
        $serie = Serie::create([
            'nome' => $nomeSerie,
            'id' => $id
        ]);

        for ($i = 1; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create([ 'id' => Uuid::generate()->string, 'numero' => $i, 'serie_id' => $serie->id]);

            for ($j = 1; $j <= $epPorTemporada; $j++) {
                $temporada->episodios()->create(['id' => Uuid::generate()->string, 'numero' => $j, 'temporada_id' => $temporada->id]);
            }
        }

        return $serie;
    }
}
