@extends('layouts.app')

@section('content')
<div class="container">
    <h2 id="tit-2" class="mb-4">Comparar Deputados</h2>

    <form method="GET" action="{{ route('deputados.comparar') }}" class="row mb-4 g-3">
        <div class="col-md-5">
            <label for="dep1" class="form-label">Deputado 1:</label>
            <select id="dep1" name="dep1" class="form-select">
                <option value="">-- Selecione --</option>
                @foreach($deputados as $dep)
                    <option value="{{ $dep->dep_id }}" {{ request('dep1') == $dep->dep_id ? 'selected' : '' }}>
                        {{ $dep->dep_nome }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-5">
            <label for="dep2" class="form-label">Deputado 2:</label>
            <select id="dep2" name="dep2" class="form-select">
                <option value="">-- Selecione --</option>
                @foreach($deputados as $dep)
                    <option value="{{ $dep->dep_id }}" {{ request('dep2') == $dep->dep_id ? 'selected' : '' }}>
                        {{ $dep->dep_nome }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Comparar</button>
        </div>
    </form>

    @if($depA && $depB)
        @php
            $totalA = $depA->despesas->sum('des_valor_documento');
            $totalB = $depB->despesas->sum('des_valor_documento');
        @endphp

        <div class="row text-center">
            <div class="col-md-6 mb-4">
                <div class="card h-100 {{ $totalA > $totalB ? 'border-success' : '' }}">
                    <img src="{{ $depA->dep_url_foto ?? 'https://via.placeholder.com/150?text=Sem+Foto' }}"
                         class="card-img-top mx-auto mt-3 rounded-circle"
                         style="width: 150px; height: 150px; object-fit: cover;"
                         alt="Foto do deputado {{ $depA->dep_nome }}"
                         onerror="this.onerror=null;this.src='https://via.placeholder.com/150?text=Sem+Foto';">
                    <div class="card-body">
                        <h5 class="card-title">{{ $depA->dep_nome }}</h5>
                        <p><strong>Partido:</strong> {{ $depA->partido->par_nome ?? '-' }}</p>
                        <p><strong>UF:</strong> {{ $depA->uf->uf_sigla ?? '-' }}</p>
                        <p><strong>Total de Despesas:</strong> 
                            <span class="{{ $totalA > $totalB ? 'text-success fw-bold' : '' }}">
                                R$ {{ number_format($totalA, 2, ',', '.') }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card h-100 {{ $totalB > $totalA ? 'border-success' : '' }}">
                    <img src="{{ $depB->dep_url_foto ?? 'https://via.placeholder.com/150?text=Sem+Foto' }}"
                         class="card-img-top mx-auto mt-3 rounded-circle"
                         style="width: 150px; height: 150px; object-fit: cover;"
                         alt="Foto do deputado {{ $depB->dep_nome }}"
                         onerror="this.onerror=null;this.src='https://via.placeholder.com/150?text=Sem+Foto';">
                    <div class="card-body">
                        <h5 class="card-title">{{ $depB->dep_nome }}</h5>
                        <p><strong>Partido:</strong> {{ $depB->partido->par_nome ?? '-' }}</p>
                        <p><strong>UF:</strong> {{ $depB->uf->uf_sigla ?? '-' }}</p>
                        <p><strong>Total de Despesas:</strong> 
                            <span class="{{ $totalB > $totalA ? 'text-success fw-bold' : '' }}">
                                R$ {{ number_format($totalB, 2, ',', '.') }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-info text-center">
            <strong>
            {{ 
                $totalA == $totalB 
                ? 'Ambos gastaram o mesmo valor.' 
                : ($totalA > $totalB ? $depA->dep_nome : $depB->dep_nome) 
            }}
            gastou mais.
            </strong>
        </div>
    @elseif($depA || $depB)
        <div class="alert alert-warning">Selecione dois deputados para comparar.</div>
    @endif
</div>
@endsection
