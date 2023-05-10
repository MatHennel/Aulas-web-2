<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veterinario extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = "veterinarios";

    protected $fillable = ['nome', 'crmv','especialidade'];
}
