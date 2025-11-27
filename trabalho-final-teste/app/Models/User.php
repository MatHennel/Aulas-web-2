<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuario';

    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo_usuario',      // FK para tipos_usuarios
        'cpfOuCep',
        'dataNascimento',
        'descricao',
        'empresa',
        'dataCriacao',
        'ativo',
        'endereco',
        'telefone',
        'avaliacao',
    ];

    protected $hidden = [
        'senha',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'dataNascimento'    => 'date',
        'dataCriacao'       => 'date',
        'ativo'             => 'boolean',
        'avaliacao'         => 'float',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONAMENTOS
    |--------------------------------------------------------------------------
    */

    // Tipo de usuário (1 = Dev, 2 = Cliente)
    public function tipoUsuario()
    {
        return $this->belongsTo(TipoUsuario::class, 'tipo_usuario');
    }

    // Projetos que o usuário (cliente) criou
    public function projetosCriados()
    {
        return $this->hasMany(Projeto::class, 'cliente_id');
    }

    // Projetos em que ele é dev selecionado
    public function projetosDevSelecionado()
    {
        return $this->hasMany(Projeto::class, 'dev_selecionado_id');
    }

    // Projetos em que ele é dev orientador
    public function projetosDevOrientador()
    {
        return $this->hasMany(Projeto::class, 'dev_orientador_selecionado_id');
    }

    // Projetos em que ele se inscreveu (via tabela "inscricoes")
    public function projetosInscritos()
    {
        return $this->belongsToMany(Projeto::class, 'inscricoes', 'user_id', 'projeto_id')
                    ->withTimestamps();
    }

    // Devs participantes no relacionamento projeto_dev
    public function projetosParticipando()
    {
        return $this->belongsToMany(Projeto::class, 'projeto_dev', 'dev_id', 'projeto_id')
                    ->withTimestamps();
    }
}
