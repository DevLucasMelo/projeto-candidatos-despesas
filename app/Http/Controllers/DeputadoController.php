<?php

namespace App\Http\Controllers;

use App\Models\Deputado;
use App\Models\Uf;
use App\Models\Partido;
use Illuminate\Http\Request;

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

    public function despesas($id)
    {
        $deputado = Deputado::with(['despesas'])->findOrFail($id);

        return view('deputados.despesas', compact('deputado'));
    }

}
