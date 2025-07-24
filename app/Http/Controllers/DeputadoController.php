<?php

namespace App\Http\Controllers;

use App\Models\Deputado;
use App\Models\Uf;
use App\Models\Partido;
use Illuminate\Http\Request;
use App\Models\Despesa;
use Illuminate\Support\Facades\DB;


class DeputadoController extends Controller
{
    public function index(Request $request)
    {
        $deputados = Deputado::with(['despesas', 'partido', 'uf'])
            ->when($request->nome, fn($q) =>
                $q->where('dep_nome', 'like', '%' . $request->nome . '%')
            )
            ->when($request->partido, fn($q) =>
                $q->whereHas('partido', fn($sub) =>
                    $sub->where('par_nome', $request->partido)
                )
            )
            ->when($request->uf, fn($q) =>
                $q->whereHas('uf', fn($sub) =>
                    $sub->where('uf_sigla', $request->uf)
                )
            )
            ->when($request->despesa, fn($q) =>
                $q->whereHas('despesas', fn($sub) =>
                    $sub->where('des_tipo_despesa', 'like', '%' . $request->despesa . '%')
                )
            )
            ->paginate(12);

        $ufs = Uf::orderBy('uf_sigla')->get();
        $partidos = Partido::orderBy('par_nome')->get();

        return view('deputados.index', compact('deputados', 'ufs', 'partidos'));
    }

    public function show($id)
    {
        $deputado = Deputado::with(['despesas', 'partido', 'uf'])->findOrFail($id);
        return view('deputados.show', compact('deputado'));
    }

    public function info($id)
    {
        $deputado = Deputado::with(['partido', 'uf'])->findOrFail($id);
        return view('deputados.info', compact('deputado'));
    }

    public function despesas($id, Request $request)
    {
    $deputado = Deputado::with(['despesas', 'partido', 'uf'])->findOrFail($id);

    $ordenar = $request->get('ordenar', 'data_desc'); 
    $despesas = $deputado->despesas;

    switch ($ordenar) {
        case 'valor':
            $despesas = $despesas->sortBy('des_valor_documento');
            break;
        case 'valor_desc':
            $despesas = $despesas->sortByDesc('des_valor_documento');
            break;
        case 'data':
            $despesas = $despesas->sortBy('des_data_documento');
            break;
        case 'data_desc':
        default:
            $despesas = $despesas->sortByDesc('des_data_documento');
            break;
    }

    return view('deputados.despesas', [
        'deputado' => $deputado,
        'despesasOrdenadas' => $despesas,
        'ordenar' => $ordenar
    ]);
    }

   public function dashboard()
{
    $totalDeputados = Deputado::count();

    $totalDespesas = Despesa::sum('des_valor_documento');

    $partidoTop = Partido::select('par_nome')
        ->join('deputados', 'partidos.par_id', '=', 'deputados.dep_par_id')
        ->join('despesas', 'deputados.dep_id', '=', 'despesas.des_dep_id')
        ->selectRaw('partidos.par_nome, SUM(despesas.des_valor_documento) as total')
        ->groupBy('partidos.par_nome')
        ->orderByDesc('total')
        ->value('par_nome');

    $topDespesas = DB::table('despesas')
        ->join('deputados', 'despesas.des_dep_id', '=', 'deputados.dep_id')
        ->select('deputados.dep_nome', DB::raw('MAX(despesas.des_valor_documento) as maior_despesa'))
        ->groupBy('deputados.dep_nome')
        ->orderByDesc('maior_despesa')
        ->limit(10)
        ->get();

    return view('deputados.dashboard', compact('totalDeputados', 'totalDespesas', 'partidoTop', 'topDespesas'));
}

    public function comparar(Request $request)
    {
    $deputados = \App\Models\Deputado::with(['partido', 'uf', 'despesas'])->orderBy('dep_nome')->get();
    $depA = $request->dep1 ? $deputados->firstWhere('dep_id', $request->dep1) : null;
    $depB = $request->dep2 ? $deputados->firstWhere('dep_id', $request->dep2) : null;

    return view('deputados.comparar', compact('deputados', 'depA', 'depB'));
    }


}
