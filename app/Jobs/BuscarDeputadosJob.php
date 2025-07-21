<?php

namespace App\Jobs;

use App\Models\Deputado;
use App\Models\Partido;
use App\Models\Uf;
use App\Jobs\BuscarDespesasDeputadoJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class BuscarDeputadosJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $response = Http::get('https://dadosabertos.camara.leg.br/api/v2/deputados');

        foreach ($response['dados'] as $dado) {
            $uf = Uf::firstOrCreate(['uf_sigla' => $dado['siglaUf']]);

            $partido = Partido::firstOrCreate(['par_nome' => $dado['siglaPartido']]);

            Deputado::updateOrCreate(
                ['dep_id' => $dado['id']],
                [
                    'dep_nome' => $dado['nome'],
                    'dep_uri' => $dado['uri'],
                    'dep_url_foto' => $dado['urlFoto'],
                    'dep_uf_id' => $uf->uf_id,
                    'dep_par_id' => $partido->par_id,
                ]
            );

            BuscarDespesasDeputadoJob::dispatch($dado['id']);
        }
    }
}
