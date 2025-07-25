@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header" id="info-dep">
        Informações do Deputado
    </div>
    <div class="card-body">
        <div class="text-center mb-4">
            <img src="{{ $deputado->dep_url_foto }}" alt="Foto" class="img-fluid" style="max-width: 200px;">
        </div>

        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Nome:</strong> {{ $deputado->dep_nome }}</li>
            <li class="list-group-item"><strong>Partido:</strong> {{ $deputado->partido?->par_nome ?? '-' }}</li>
            <li class="list-group-item"><strong>UF:</strong> {{ $deputado->uf?->uf_sigla ?? '-' }}</li>
            <li class="list-group-item"><strong>ID na Câmara:</strong> {{ $deputado->dep_id }}</li>
            <li class="list-group-item"><strong>Prédio:</strong> {{ $deputado->gabinete->gab_predio ?? 'Não informado' }}</li>
            <li class="list-group-item"><strong>Sala:</strong> {{ $deputado->gabinete->gab_sala ?? 'Não informado' }}</li>
            <li class="list-group-item"><strong>Andar:</strong> {{ $deputado->gabinete->gab_andar ?? 'Não informado' }}</li>
            <li class="list-group-item"><strong>Email:</strong> {{ $deputado->gabinete?->gab_email ?? '-' }}</li>
            <li class="list-group-item"><strong>Telefone:</strong> {{ $deputado->gabinete?->gab_telefone ?? '-' }}</li>
            <li class="list-group-item"><strong>Profissões:</strong> {{ $deputado->profissoes->pluck('pro_nome')->join(', ') ?: '-' }}</li>
            <li class="list-group-item"><strong>Escolaridade:</strong> {{ $deputado->dep_escolaridade ?? '-' }}</li>
            <li class="list-group-item"><strong>Situação:</strong> {{ $deputado->situacao?->sit_nome ?? '-' }}</li>
            <li class="list-group-item"><strong>Condição Eleitoral:</strong> {{ $deputado->condicaoEleitoral?->con_ele_nome ?? '-' }}</li>
            <li class="list-group-item"><strong>Município de nascimento:</strong> {{ $deputado->dep_municipio_nascimento ?? '-' }}</li>
        </ul>

        <a href="{{ route('deputados.index') }}" class="btn btn-sm btn-secondary mt-3">Voltar</a>
    </div>
</div>
@endsection
