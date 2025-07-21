<?php

namespace App\Jobs;

use App\Models\Despesa;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Http;


class BuscarDespesasDeputadoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct(public int $idDeputado) {}

   public function handle()
{
    $response = Http::get("https://dadosabertos.camara.leg.br/api/v2/deputados/{$this->idDeputado}/despesas");

    foreach ($response['dados'] as $dado) {
        Despesa::updateOrCreate(
            [
                'des_cod_documento' => $dado['codDocumento'],
                'des_dep_id' => $this->idDeputado,
            ],
            [
                'des_tipo_despesa' => $dado['tipoDespesa'] ?? null,
                'des_fornecedor' => $dado['nomeFornecedor'] ?? null,
                'des_ano' => $dado['ano'],
                'des_mes' => $dado['mes'],
                'des_valor_documento' => $dado['valorDocumento'],
                'des_valor_glosa' => $dado['valorGlosa'],
                'des_valor_liquido' => $dado['valorLiquido'],
                'des_data_documento' => $dado['dataDocumento'] ?? null,
            ]
        );
    }
}

}
