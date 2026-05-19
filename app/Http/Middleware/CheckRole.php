<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Verifica si el usuario NO ha iniciado sesión o si NO tiene el rol requerido
        if (!auth()->check() || !auth()->user()->hasRole($role)) {
            abort(403, 'Unauthorized access'); // Detiene la petición y muestra error 403
        }

        return $next($request); // Si pasa la validación, continúa con la petición
    }
}