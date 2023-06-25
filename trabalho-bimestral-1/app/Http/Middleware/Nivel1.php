<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;


class Nivel1
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

   
    public function handle(Request $request, Closure $next)
    {

        $nivel = 3;
        $routes = Route::currentRouteName();

        $route = explode('.',$routes);

        $submenus = $route[0];
        $metodos = $route[1];

        Log::debug("route: $submenus");

        if($nivel == 2 || $nivel == 3 ) return $next($request);

        if($submenus == 'cursos' || $submenus == 'eixos'){
            if($metodos == 'index') return $next($request);
            
        }

        return response()->view('templates.erro',compact('submenus'));


        

    }
}
