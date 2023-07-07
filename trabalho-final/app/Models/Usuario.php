<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = ['nome','nick_name','idade'];

    public function jogo(){
        return $this->hasMany('App\Models\Jogo','jogo_usuarios');
    }

    public function skin(){
        return $this->hasMany('App\Models\Skin');
    }
}
