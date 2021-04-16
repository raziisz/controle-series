<?php


namespace App\Services;


use App\Serie;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class CriadorDeSerie
{
    public function criarSerie(
        string $nomeSerie,
        int $qtdTemporadas,
        int $epPorTemporada,
        ?string $capa
    ): Serie
    {
        DB::beginTransaction();
        $id = Uuid::generate()->string;

        $serie = Serie::create([
            'nome' => $nomeSerie,
            'id' => $id,
            'capa' => $capa
        ]);
        $this->criarTemporadas($qtdTemporadas, $serie, $epPorTemporada);

        DB::commit();

        return $serie;
    }

    /**
     * @param int $qtdTemporadas
     * @param $serie
     * @param int $epPorTemporada
     * @throws \Exception
     */
    private function criarTemporadas(int $qtdTemporadas, $serie, int $epPorTemporada): void
    {
        for ($i = 1; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['id' => Uuid::generate()->string, 'numero' => $i, 'serie_id' => $serie->id]);
            $this->criarEpisodios($epPorTemporada, $temporada);
        }
    }

    /**
     * @param int $epPorTemporada
     * @param $temporada
     * @throws \Exception
     */
    private function criarEpisodios(int $epPorTemporada, $temporada): void
    {
        for ($j = 1; $j <= $epPorTemporada; $j++) {
            $temporada->episodios()->create(['id' => Uuid::generate()->string, 'numero' => $j, 'temporada_id' => $temporada->id]);
        }
    }
}
