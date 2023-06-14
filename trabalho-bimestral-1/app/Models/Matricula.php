<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Matricula extends Model
{
    use HasFactory;

    use SoftDeletes;

    public function aluno(){
        return $this->belongsTo('App\Models\Aluno');
    }

    public function disciplina(){
        return $this->belongsTo('App\Models\Disciplina');
    }

}
