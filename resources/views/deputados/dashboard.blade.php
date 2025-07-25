@extends('layouts.app')

@section('content')
<div class="container">
    <h2 id="tit-2" class="mb-4">Dashboard</h2>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total de Deputados</h5>
                    <p class="card-text fs-3">{{ $totalDeputados }}</p>
                    <small>Em exercício: {{ $totalDeputadosExercicio }}</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total de Despesas</h5>
                    <p class="card-text fs-3">R$ {{ number_format($totalDespesas, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Partido com Mais Gastos</h5>
                    <p class="card-text fs-5">{{ $partidoTop ?? 'N/D' }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Partido com Menos Gastos</h5>
                    <p class="card-text fs-5">{{ $partidoMenosGastos ?? 'N/D' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card text-white bg-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">Deputado que Mais Gastou</h5>
                    <p class="card-text fs-5">
                        {{ $deputadoMaisGastou->dep_nome ?? 'N/D' }}
                        @if(!empty($deputadoMaisGastou->par_nome))
                            ({{ $deputadoMaisGastou->par_nome }})
                        @endif
                        <br>
                        <strong>R$ {{ number_format($deputadoMaisGastou->total ?? 0, 2, ',', '.') }}</strong>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-dark bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Deputado que Menos Gastou</h5>
                    <p class="card-text fs-5">
                        {{ $deputadoMenosGastou->dep_nome ?? 'N/D' }}
                        @if(!empty($deputadoMenosGastou->par_nome))
                            ({{ $deputadoMenosGastou->par_nome }})
                        @endif
                        <br>
                        <strong>R$ {{ number_format($deputadoMenosGastou->total ?? 0, 2, ',', '.') }}</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Top 10 Maiores Despesas Individuais por Deputado</h5>
            <canvas
                id="graficoDespesas"
                width="100"
                height="50"
                data-labels='@json($topDespesas->pluck("dep_nome"))'
                data-valores='@json($topDespesas->pluck("maior_despesa"))'
            ></canvas>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Top 10 Profissões mais Presentes entre os Deputados</h5>
            <canvas
                id="graficoProfissoes"
                height="100"
                data-labels='@json($topProfissoes->pluck("pro_nome"))'
                data-valores='@json($topProfissoes->pluck("total"))'
            ></canvas>
        </div>
    </div>

    <div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Quantidade de Deputados por Partido</h5>
        <canvas
            id="graficoDeputadosPorPartido"
            height="100"
            data-labels='@json($deputadosPorPartido->pluck("par_nome"))'
            data-valores='@json($deputadosPorPartido->pluck("total"))'
        ></canvas>
    </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('dashboard.js') }}"></script>
@endsection
