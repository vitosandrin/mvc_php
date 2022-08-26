<?php

namespace App\Http\Middleware;

class Maintenance
{
    /**
     * Método responsavel por executar o middleware 
     * @param Request $request
     * @param Closure $next
     * @return Response 
     */
    public function handle($request, $next){
        return $next($request);
    }
}
