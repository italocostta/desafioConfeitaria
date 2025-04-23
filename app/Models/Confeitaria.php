<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Confeitaria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cep',
        'rua',
        'numero',
        'bairro',
        'estado',
        'cidade',
        'latitude',
        'longitude',
        'telefone',
    ];

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

     // Deletar os produtos associados ao excluir a confeitaria
     protected static function booted()
     {
         static::deleting(function ($confeitaria) {
             $confeitaria->produtos()->delete();
         });
     }
}
