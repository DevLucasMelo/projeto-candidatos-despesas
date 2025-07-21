<?php

namespace App\Http\Controllers;

use App\Models\Deputado;
use Illuminate\Http\Request;

class DeputadoController extends Controller
{
    public function index(Request $request)
    {
        $deputados = Deputado::with(['despesas', 'partido', 'uf'])
            ->when($request->nome, fn($q) =>
                $q->where('dep_nome', 'like', '%' . $request->nome . '%')
            )
            ->when($request->partido, function ($q) use ($request) {
                $q->whereHas('partido', fn($sub) =>
                    $sub->where('par_nome', $request->partido)
                );
            })
            ->when($request->uf, function ($q) use ($request) {
                $q->whereHas('uf', fn($sub) =>
                    $sub->where('uf_sigla', $request->uf)
                );
            })
            ->when($request->despesa, function ($q) use ($request) {
                $q->whereHas('despesas', fn($sub) =>
                    $sub->where('des_tipo_despesa', 'like', '%' . $request->despesa . '%')
                );
            })
            ->paginate(12);

        return view('deputados.index', compact('deputados'));
    }
}
