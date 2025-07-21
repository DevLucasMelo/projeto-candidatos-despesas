<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\BuscarDeputadosJob;

class DispararImportacaoDeputados extends Command
{
    protected $signature = 'importar:deputados';
    protected $description = 'Dispara o Job para importar deputados e suas despesas';

    public function handle()
    {
        BuscarDeputadosJob::dispatch();
        $this->info('Job de importação de deputados disparado com sucesso!');
    }
}