<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'type_id',       // 1 = Cliente, 2 = Desenvolvedor
        'cpfOuCep',      // Cliente
        'dataNascimento',// Desenvolvedor
        'descricao',     // Desenvolvedor
        'empresa',       // Cliente
        'dataCriacao',
        'ativo',
        'endereco',
        'telefone',
        'avaliacao',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'dataNascimento' => 'date',
        'dataCriacao' => 'date',
        'ativo' => 'boolean',
        'avaliacao' => 'float',
    ];

    public function projeto()
    {
        return $this->hasMany('\App\Models\Projeto');
    }

    public function tipoUsuario()
    {
        return $this->belongsTo('\App\Models\TipoUsuario', 'type_id');
    }

    // User.php (apenas para devs)
public function projetosInscritos() {
    return $this->belongsToMany(Projeto::class, 'inscricoes', 'user_id', 'projeto_id');
}

}
