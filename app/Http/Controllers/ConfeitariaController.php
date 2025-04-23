<?php

namespace App\Http\Controllers;

use App\Models\Confeitaria;
use Illuminate\Http\Request;
use App\Http\Requests\ConfeitariaRequest;
use Inertia\Inertia;

class ConfeitariaController extends Controller
{
    // Listar todas as confeitarias
    public function index()
    {
        $confeitarias = Confeitaria::all();

        return Inertia::render('Confeitarias/Index', [
            'confeitarias' => $confeitarias
        ]);
    }

    // Formulário de criação
    public function create()
    {
        return Inertia::render('Confeitarias/Create');
    }

    // Salvar nova confeitaria
    public function store(ConfeitariaRequest $request)
    {
        Confeitaria::create($request->validated());

        return redirect()
            ->route('confeitarias.index')
            ->with('success', 'Confeitaria cadastrada com sucesso!');
    }

    // Detalhes de uma confeitaria
    public function show(Confeitaria $confeitaria)
    {
        return Inertia::render('Confeitarias/Show', [
            'confeitaria' => $confeitaria
        ]);
    }

    // Formulário de edição
    public function edit(Confeitaria $confeitaria)
    {
        return Inertia::render('Confeitarias/Edit', [
            'confeitaria' => $confeitaria
        ]);
    }

    // Atualizar confeitaria
    public function update(ConfeitariaRequest $request, Confeitaria $confeitaria)
    {
        $confeitaria->update($request->validated());

        return redirect()
            ->route('confeitarias.index')
            ->with('success', 'Confeitaria atualizada com sucesso!');
    }

    // Excluir confeitaria
    public function destroy(Confeitaria $confeitaria)
    {
        $confeitaria->delete();

        return redirect()
            ->route('confeitarias.index')
            ->with('success', 'Confeitaria excluída com sucesso!');
    }
}
