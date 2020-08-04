<?php

namespace App\Http\Middleware;

use Closure;

class verifyUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(1/* O usuario está logado && republica pertence ao usuário */){
            return $next($request);
        }
    }
}
