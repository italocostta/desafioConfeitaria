<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        // Regras comuns para store e update
        $rules = [
            'confeitaria_id'        => 'required|exists:confeitarias,id',
            'nome'                  => 'required|string|max:255',
            'valor'                 => 'required|numeric|min:0',
            'descricao'             => 'nullable|string',
            'imagens_existentes'    => 'sometimes|array',
            'imagens_existentes.*'  => 'integer|exists:produto_imagens,id',
            'imagens'               => $this->isMethod('post') ? 'required|array' : 'sometimes|array',
            'imagens.*'             => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        return $rules;
    }
}