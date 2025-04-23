<?php

use App\Models\Confeitaria;
use App\Http\Requests\StoreConfeitariaRequest;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

class ConfeitariaController extends Controller
{
    public function index()
    {
        $confeitarias = Confeitaria::latest()->get();
        return Inertia::render('Confeitarias/Index', [
            'confeitarias' => $confeitarias
        ]);
    }

    public function store(StoreConfeitariaRequest $request)
    {
        Confeitaria::create($request->validated());
        return redirect()->back()->with('success', 'Confeitaria criada com sucesso!');
    }

    public function destroy(Confeitaria $confeitaria)
    {
        $confeitaria->delete();
        return redirect()->back()->with('success', 'Confeitaria excluída com sucesso!');
    }
}
