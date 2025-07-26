@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header" id="info-dep">
        <h4 class="mb-0">Informações do Deputado</h4>
    </div>
    <div class="card-body">
        <div class="text-center mb-4">
            <img src="{{ $deputado->dep_url_foto }}" alt="Foto do Deputado" class="rounded-circle img-fluid" style="max-width: 180px; border: 3px solid #0d6efd;">
        </div>

        <div class="row">
            <section class="col-md-6 mb-4">
                <h5 class="mb-3 text-primary border-bottom pb-2">Dados do Deputado</h5>
                <ul class="list-group list-group-flush shadow-sm">
                    <li class="list-group-item"><strong>Nome:</strong> {{ $deputado->dep_nome }}</li>
                    <li class="list-group-item"><strong>Partido:</strong> {{ $deputado->partido?->par_nome ?? '-' }}</li>
                    <li class="list-group-item"><strong>UF:</strong> {{ $deputado->uf?->uf_sigla ?? '-' }}</li>
                    <li class="list-group-item"><strong>ID na Câmara:</strong> {{ $deputado->dep_id }}</li>
                    <li class="list-group-item"><strong>Profissões:</strong> {{ $deputado->profissoes->pluck('pro_nome')->join(', ') ?: '-' }}</li>
                    <li class="list-group-item"><strong>Escolaridade:</strong> {{ $deputado->dep_escolaridade ?? '-' }}</li>
                    <li class="list-group-item"><strong>Situação:</strong> {{ $deputado->situacao?->sit_nome ?? '-' }}</li>
                    <li class="list-group-item"><strong>Condição Eleitoral:</strong> {{ $deputado->condicaoEleitoral?->con_ele_nome ?? '-' }}</li>
                    <li class="list-group-item"><strong>Município de nascimento:</strong> {{ $deputado->dep_municipio_nascimento ?? '-' }}</li>
                </ul>
            </section>

            <section class="col-md-6 mb-4">
                <h5 class="mb-3 text-primary border-bottom pb-2">Dados do Gabinete</h5>
                <ul class="list-group list-group-flush shadow-sm">
                    <li class="list-group-item"><strong>Prédio:</strong> {{ $deputado->gabinete->gab_predio ?? 'Não informado' }}</li>
                    <li class="list-group-item"><strong>Sala:</strong> {{ $deputado->gabinete->gab_sala ?? 'Não informado' }}</li>
                    <li class="list-group-item"><strong>Andar:</strong> {{ $deputado->gabinete->gab_andar ?? 'Não informado' }}</li>
                    <li class="list-group-item"><strong>Email:</strong> <a href="mailto:{{ $deputado->gabinete?->gab_email ?? '' }}">{{ $deputado->gabinete?->gab_email ?? '-' }}</a></li>
                    <li class="list-group-item"><strong>Telefone:</strong> {{ $deputado->gabinete?->gab_telefone ?? '-' }}</li>
                </ul>
            </section>
        </div>

        <div class="text-end">
            <a href="{{ route('deputados.index') }}" class="btn btn-outline-primary">Voltar</a>
        </div>
    </div>
</div>
@endsection
