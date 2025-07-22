@extends('layouts.app')

@section('content')
<h2>Despesas de {{ $deputado->dep_nome }}</h2>

@if($deputado->despesas->isEmpty())
    <p>Nenhuma despesa registrada.</p>
@else
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Fornecedor</th>
                <th>Valor</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deputado->despesas as $despesa)
                <tr>
                    <td>{{ $despesa->des_tipo_despesa }}</td>
                    <td>{{ $despesa->des_nome_fornecedor }}</td>
                    <td>R$ {{ number_format($despesa->des_valor_documento, 2, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($despesa->des_data_documento)->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
