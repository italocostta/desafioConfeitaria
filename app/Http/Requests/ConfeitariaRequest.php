<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfeitariaRequest extends FormRequest
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
        return [
            'nome'      => 'required|string|max:255',
            'cep'       => 'required|string|size:8',
            'rua'       => 'required|string|max:255',
            'numero'    => 'required|string|max:10',
            'bairro'    => 'required|string|max:100',
            'estado'    => 'required|string|size:2',
            'cidade'    => 'required|string|max:100',
            'latitude'  => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'telefone'  => 'nullable|string|max:20',
        ];
    }
}
