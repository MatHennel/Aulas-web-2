<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;


class Nivel2
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

        if($nivel == 3) return $next($request);

        if($submenus == 'matriculas' || $submenus == 'docencias') return response()->view('templates.erro',compact('submenus'));

        if($submenus == 'eixos' || $submenus == 'cursos'){ return $next($request); }
        else{
            if($metodos == 'index') return $next($request); 
        }
        
        

        return response()->view('templates.erro',compact('submenus'));
        
    }
}
