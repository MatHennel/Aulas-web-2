<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Projeto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'projetos';

    protected $fillable = [
        'nome',
        'descricao',
        'valor',
        'dataEntrega',
        'dataFinalizacao',
        'status_id',
        'cliente_id',
        'dev_selecionado_id',
        'dev_orientador_selecionado_id'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONAMENTOS
    |--------------------------------------------------------------------------
    */

    // Status do projeto
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    // Cliente dono do projeto
    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    // Dev selecionado principal
    public function devSelecionado()
    {
        return $this->belongsTo(User::class, 'dev_selecionado_id');
    }

    // Dev orientador selecionado
    public function devOrientador()
    {
        return $this->belongsTo(User::class, 'dev_orientador_selecionado_id');
    }

    // Devs inscritos no projeto (tabela pivot projeto_dev)
    public function devs()
    {
        return $this->belongsToMany(User::class, 'projeto_dev', 'projeto_id', 'dev_id')
                    ->withTimestamps();
    }

    public function mensagens()
    {
        return $this->hasMany(Chat::class, 'projeto_id');
    }

    public function avaliacao()
    {
        return $this->hasOne(Avaliacao::class);
    }


}
