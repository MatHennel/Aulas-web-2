<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use \App\Models\Professor;
use \App\Models\Aluno;
use \App\Models\Curso;
use \App\Models\Disciplina;
use App\Models\Eixo;

class ExampleTest extends TestCase
{
    /** @test*/ 
    public function teste_colunas_professores()
    {
        $user = new Professor;
        $expected = [
            'nome',
            'email',
            'siape',
            'ativo'
        ];

        
        $arrayCompared = array_diff($expected,$user->getFillable());


        $this->assertEquals(0,count($arrayCompared));
    }

    /** @test*/ 
    public function teste_colunas_aluno()
    {
        $user = new Aluno;
        $expected = [
            'nome'
        ];

        
        $arrayCompared = array_diff($expected,$user->getFillable());


        $this->assertEquals(0,count($arrayCompared));
    }

    public function teste_colunas_curso()
    {
        $user = new Curso;
        $expected = [
            'nome',
            'sigla',
            'tempo',
            'eixo_id'
        ];

        
        $arrayCompared = array_diff($expected,$user->getFillable());


        $this->assertEquals(0,count($arrayCompared));
    }

    public function teste_colunas_disciplina()
    {
        $user = new Disciplina;
        $expected = [
            'nome',
            'carga',
            'curso_id'
        ];

        
        $arrayCompared = array_diff($expected,$user->getFillable());


        $this->assertEquals(0,count($arrayCompared));
    }

    public function teste_colunas_eixo()
    {
        $user = new Eixo;
        $expected = [
            'nome',
        ];

        
        $arrayCompared = array_diff($expected,$user->getFillable());


        $this->assertEquals(0,count($arrayCompared));
    }
}
