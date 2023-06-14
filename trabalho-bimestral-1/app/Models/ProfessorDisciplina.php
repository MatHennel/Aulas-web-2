<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessorDisciplina extends Model
{
    use HasFactory;

    protected $table = "professor_disciplinas";

    protected $fillable = ['professor_id','disciplina_id'];


    public function disciplina(){
        return $this->hasMany('App\Models\Disciplina','professor_disciplinas');
    }

    public function professor(){
        return $this->belongsTo('App\Models\Professor','professor_disciplinas');
    }
}
