@extends('layouts.app')

@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Filtrar deputados</span>
    </div>
    <div class="collapse show" id="filtrosCollapse">
        <div class="card-body">
            <form method="GET" action="{{ route('deputados.index') }}">
                <div class="row g-2 align-items-end">
                    <div class="col-md-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" id="nome" name="nome" class="form-control form-control-sm"
                            value="{{ request('nome') }}" placeholder="Digite o nome">
                    </div>

                    <div class="col-md-2">
                        <label for="uf" class="form-label">UF</label>
                        <select id="uf" name="uf" class="form-select form-select-sm">
                            <option value="">Todas</option>
                            @foreach($ufs as $uf)
                                <option value="{{ $uf->uf_sigla }}" {{ request('uf') == $uf->uf_sigla ? 'selected' : '' }}>
                                    {{ $uf->uf_sigla }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="partido" class="form-label">Partido</label>
                        <select id="partido" name="partido" class="form-select form-select-sm">
                            <option value="">Todos</option>
                            @foreach($partidos as $partido)
                                <option value="{{ $partido->par_nome }}" {{ request('partido') == $partido->par_nome ? 'selected' : '' }}>
                                    {{ $partido->par_nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-sm btn-primary">Filtrar</button>
                        <a href="{{ route('deputados.index') }}" class="btn btn-sm btn-outline-secondary">Limpar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($deputados as $deputado)
        <div class="col">
            <div class="card h-100">
                <img src="{{ $deputado->dep_url_foto }}" class="card-img-top mx-auto d-block" style="max-width: 50%;" alt="Foto de {{ $deputado->dep_nome }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $deputado->dep_nome }}</h5>
                    <p class="card-text">
                        <strong>Partido:</strong> {{ $deputado->partido?->par_nome ?? '-' }}<br>
                        <strong>UF:</strong> {{ $deputado->uf?->uf_sigla ?? '-' }}
                    </p>
                    <a href="{{ route('deputados.info', ['id' => $deputado->dep_id]) }}" class="btn btn-primary btn-sm me-2">Ver Informações do Deputado</a>
                    <a href="{{ route('deputados.despesas', ['id' => $deputado->dep_id]) }}" class="btn btn-success btn-sm">Ver Despesas</a>

                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
