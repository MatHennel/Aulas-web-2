<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $fillable = [
        'projeto_id',
        'dev_id',
        'cliente_id',
        'nota',
        'descricao'
    ];

    protected $table = 'avaliacoes';


    public function projeto()
    {
        return $this->belongsTo(Projeto::class);
    }

    public function dev()
    {
        return $this->belongsTo(User::class, 'dev_id');
    }

    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }
}
