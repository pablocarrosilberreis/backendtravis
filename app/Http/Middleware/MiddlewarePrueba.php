<?php

namespace App\Http\Middleware;

use App\Exceptions\AccesoDenegadoException;
use Closure;
use Illuminate\Http\Request;

class MiddlewarePrueba
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $tokenBearer = $request->bearerToken();
        if(is_null($tokenBearer)) throw new AccesoDenegadoException();

        return $next($request);
    }
}
