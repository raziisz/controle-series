<?php


namespace App\Services;


use App\{Episodio, Events\SerieApagada, Temporada, Serie};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class RemovedorDeSerie
{
    public function removerSerie(string $serieId): string
    {
        $nomeSerie = '';
        DB::transaction(function () use ($serieId, &$nomeSerie) {
            $serie = Serie::find($serieId);
            $serieObj = (object) $serie->toArray();

            $nomeSerie = $serie->nome;
            $this->removerTemporadas($serie);
            $serie->delete();

            $evento = new SerieApagada($serieObj);
            event($evento);

        });

        return $nomeSerie;

    }

    /**
     * @param $serie
     * @throws \Exception
     */
    private function removerTemporadas(Serie $serie): void
    {
        $serie->temporadas->each(function (Temporada $temporada) {
            $this->removerEpisodios($temporada);
            $temporada->delete();
        });


    }

    /**
     * @param Temporada $temporada
     * @throws \Exception
     */
    private function removerEpisodios(Temporada $temporada): void
    {
        $temporada->episodios->each(function (Episodio $episodio) {
            $episodio->delete();
        });

    }
}
