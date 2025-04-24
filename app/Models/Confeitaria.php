<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Confeitaria extends Model
{
    use HasFactory;

    /**
     * Os atributos atribuíveis em massa
     *
     * @var array<string>
     */
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

    /**
     * Relacionamento: uma confeitaria tem muitos produtos
     *
     * @return HasMany
     */
    public function produtos(): HasMany
    {
        return $this->hasMany(Produto::class);
    }

    /**
     * Boot method to handle model events
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::deleting(function (Confeitaria $confeitaria) {
            // Excluir produtos associados antes de excluir a confeitaria
            $confeitaria->produtos()->delete();
        });
    }
}
