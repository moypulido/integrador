<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
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
        if (!Auth::check()) {
            // Redirigir al usuario a la página de login o registro si no está autenticado
            return redirect()->route('login.index'); // Puedes cambiar 'login' por 'register' si prefieres
        }

        return $next($request);
    }
}