<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'confeitaria_id' => 'required|exists:confeitarias,id',
            'nome' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'descricao' => 'nullable|string',
            'imagens' => 'required|array', 
            'imagens.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ];
    }
}
