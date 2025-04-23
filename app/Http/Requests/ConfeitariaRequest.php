<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfeitariaRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     */
    public function authorize(): bool
    {
        return true; // deve ser true para permitir o uso da request
    }

    /**
     * Regras de validação para criação e atualização de confeitarias.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:255',
            'cep' => 'required|string|size:8',
            'rua' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'bairro' => 'required|string|max:100',
            'estado' => 'required|string|max:2',
            'cidade' => 'required|string|max:100',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'telefone' => 'nullable|string|max:20',
        ];
    }
}
