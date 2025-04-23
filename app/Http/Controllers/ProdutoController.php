<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Confeitaria;
use App\Models\ProdutoImagem;  // Importando o modelo ProdutoImagem
use Illuminate\Support\Facades\Storage;  // Importando o facade Storage
use App\Http\Requests\ProdutoRequest;
use Inertia\Inertia;

class ProdutoController extends Controller
{
    // Listar todos os produtos
    public function index()
    {
        $produtos = Produto::with('confeitaria')->get();

        return Inertia::render('Produtos/Index', [
            'produtos' => $produtos
        ]);
    }

    // Formulário de criação
    public function create()
    {
        return Inertia::render('Produtos/Create', [
            'confeitarias' => Confeitaria::all()
        ]);
    }

    // Salvar novo produto
    public function store(ProdutoRequest $request)
    {
        // Criar o produto com os dados validados
        $produto = Produto::create($request->validated());

        // Verificar se imagens foram enviadas
        if ($request->hasFile('imagens')) {
            foreach ($request->file('imagens') as $image) {
                // Armazenar a imagem no diretório 'produtos' e salvar o caminho no banco de dados
                $path = $image->store('produtos', 'public');
                
                // Criar uma nova entrada na tabela de imagens
                $produto->imagens()->create(['path' => $path]);
            }
        }

        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto cadastrado com sucesso!');
    }

    // Detalhes de um produto
    public function show(Produto $produto)
    {
        $produto->load('confeitaria', 'imagens'); // Carregar também as imagens associadas

        return Inertia::render('Produtos/Show', [
            'produto' => $produto
        ]);
    }

    // Formulário de edição
    public function edit(Produto $produto)
    {
        return Inertia::render('Produtos/Edit', [
            'produto' => $produto,
            'confeitarias' => Confeitaria::all()
        ]);
    }

    // Atualizar o produto
    public function update(ProdutoRequest $request, Produto $produto)
    {
        // Atualizar os dados do produto com os dados validados
        $produto->update($request->validated());

        // Verificar se imagens foram enviadas
        if ($request->hasFile('imagens')) {
            // Obter as imagens enviadas no formulário
            $imagensEnviadas = $request->file('imagens');

            // Excluir as imagens que não foram enviadas novamente
            foreach ($produto->imagens as $imagem) {
                if (!in_array($imagem->path, $imagensEnviadas)) {
                    // Remover o arquivo da pasta de armazenamento
                    Storage::disk('public')->delete($imagem->path);
                    // Excluir a imagem do banco de dados
                    $imagem->delete();
                }
            }

            // Adicionar as novas imagens
            foreach ($imagensEnviadas as $image) {
                // Armazenar a imagem no diretório 'produtos' e salvar o caminho no banco de dados
                $path = $image->store('produtos', 'public');
                
                // Criar uma nova entrada na tabela de imagens
                $produto->imagens()->create(['path' => $path]);
            }
        }

        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto atualizado com sucesso!');
    }

    // Excluir produto
    public function destroy(Produto $produto)
    {
        // Excluir as imagens associadas ao produto antes de excluí-lo
        foreach ($produto->imagens as $imagem) {
            // Remover o arquivo da pasta de armazenamento
            Storage::disk('public')->delete($imagem->path);
            // Excluir a imagem do banco de dados
            $imagem->delete();
        }

        $produto->delete();

        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto excluído com sucesso!');
    }
}
