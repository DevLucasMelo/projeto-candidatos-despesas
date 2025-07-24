<?php

namespace App\Jobs;

use App\Models\Deputado;
use App\Models\Partido;
use App\Models\Uf;
use App\Models\Gabinete;
use App\Models\Situacao;
use App\Models\CondicaoEleitoral;
use App\Models\RedeSocial;
use App\Models\Profissao;
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

            $detalhes = Http::get("https://dadosabertos.camara.leg.br/api/v2/deputados/{$dado['id']}")->json('dados');

            $gab = $detalhes['ultimoStatus']['gabinete'] ?? [];
            $sit = $detalhes['ultimoStatus']['situacao'] ?? 'Desconhecida';
            $con = $detalhes['ultimoStatus']['condicaoEleitoral'] ?? 'Desconhecida';
            $redes = $detalhes['redeSocial'] ?? [];

            $gabinete = Gabinete::updateOrCreate(
                ['gab_id' => $gab['id'] ?? null],
                [
                    'gab_predio' => $gab['predio'] ?? null,
                    'gab_sala' => $gab['sala'] ?? null,
                    'gab_andar' => $gab['andar'] ?? null,
                    'gab_telefone' => $gab['telefone'] ?? null,
                    'gab_email' => $gab['email'] ?? null,
                ]
            );

            $situacao = Situacao::firstOrCreate(['sit_nome' => $sit]);
            $condicao = CondicaoEleitoral::firstOrCreate(['con_ele_nome' => $con]);

            $deputado = Deputado::updateOrCreate(
                ['dep_id' => $dado['id']],
                [
                    'dep_nome' => $dado['nome'],
                    'dep_uri' => $dado['uri'],
                    'dep_url_foto' => $dado['urlFoto'],
                    'dep_uf_id' => $uf->uf_id,
                    'dep_par_id' => $partido->par_id,
                    'dep_gab_id' => $gabinete->gab_id,
                    'dep_sit_id' => $situacao->sit_id,
                    'dep_con_ele_id' => $condicao->con_ele_id,
                    'dep_data_nascimento' => $detalhes['dataNascimento'] ?? null,
                    'dep_municipio_nascimento' => $detalhes['municipioNascimento'] ?? null,
                    'dep_escolaridade' => $detalhes['escolaridade'] ?? null,
                ]
            );

            $deputado->redesSociais()->delete();
            foreach ($redes as $url) {
                RedeSocial::create([
                'red_soc_dep_id' => $deputado->dep_id,
                'red_soc_url' => $url,
            ]);
            }

            $profissoesResponse = Http::get("https://dadosabertos.camara.leg.br/api/v2/deputados/{$dado['id']}/profissoes");

            if ($profissoesResponse->successful()) {
                $deputado->profissoes()->detach(); 
                foreach ($profissoesResponse['dados'] as $profissaoData) {
                    $nome = $profissaoData['titulo'] ?? null;

                    if (!empty($nome)) {
                        $profissao = Profissao::firstOrCreate(['pro_nome' => $nome]);
                        $deputado->profissoes()->syncWithoutDetaching([$profissao->pro_id]);
                    }
                }
            }

            BuscarDespesasDeputadoJob::dispatch($dado['id']);
        }
    }
}
