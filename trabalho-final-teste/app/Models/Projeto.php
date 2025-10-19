<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'valor',
        'dataEntrega',
        'user_id',
    ];

    // Relação com os devs que estão participando do projeto
    public function devs()
    {
        return $this->belongsToMany(User::class, 'projeto_dev', 'projeto_id', 'dev_id');
    }

    // Caso tenha um dev selecionado principal
    public function devSelecionado()
    {
        return $this->belongsTo(User::class, 'dev_selecionado_id');
    }
}
