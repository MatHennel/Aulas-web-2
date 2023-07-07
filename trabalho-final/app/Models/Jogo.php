<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
    use HasFactory;

    public function usuario(){
        return $this->hasMany('App\Models\Usuario','usuario_usuarios');
    }

    public function skin(){
        return $this->hasMany('App\Models\Skin');
    }
}
