<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Usuario;
class UserTest extends TestCase
{
    /** @test*/
    public function checar_usuarios_coluna(): void
    {
        $user = new Usuario;
        $expected = [
            'nome',
            'nick_name',
            'idade'
        ];

        
        $arrayCompared = array_diff($expected,$user->getFillable());


        $this->assertEquals(0,count($arrayCompared));
    }
}
