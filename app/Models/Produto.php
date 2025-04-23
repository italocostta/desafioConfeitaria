<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'confeitaria_id',
        'nome',
        'valor',
        'descricao',
    ];

    public function confeitaria()
    {
        return $this->belongsTo(Confeitaria::class);
    }

    public function imagens()
    {
        return $this->hasMany(ProdutoImagem::class); // TODO
    }
}
