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
                <th>
                    <a href="{{ route('deputados.despesas', ['id' => $deputado->dep_id, 'ordenar' => $ordenar === 'valor' ? 'valor_desc' : 'valor']) }}">
                        Valor
                        @if(str_starts_with($ordenar, 'valor'))
                            {!! $ordenar === 'valor' ? '↑' : '↓' !!}
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('deputados.despesas', ['id' => $deputado->dep_id, 'ordenar' => $ordenar === 'data' ? 'data_desc' : 'data']) }}">
                        Data
                        @if(str_starts_with($ordenar, 'data'))
                            {!! $ordenar === 'data' ? '↑' : '↓' !!}
                        @endif
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($despesasOrdenadas as $despesa)
                @php $total += $despesa->des_valor_documento; @endphp
                <tr>
                    <td>{{ $despesa->des_tipo_despesa }}</td>
                    <td>{{ $despesa->des_nome_fornecedor }}</td>
                    <td>R$ {{ number_format($despesa->des_valor_documento, 2, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($despesa->des_data_documento)->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">Total</th>
                <th colspan="2">R$ {{ number_format($total, 2, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
@endif
@endsection
