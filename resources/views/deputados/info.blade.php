@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
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
            <li class="list-group-item"><strong>Email:</strong> {{ $deputado->dep_email }}</li>
            <li class="list-group-item"><strong>Telefone:</strong> {{ $deputado->dep_telefone }}</li>
            <li class="list-group-item"><strong>Gabinete:</strong> {{ $deputado->dep_gabinete }}</li>
        </ul>

        <a href="{{ route('deputados.index') }}" class="btn btn-sm btn-secondary mt-3">Voltar</a>
    </div>
</div>
@endsection
