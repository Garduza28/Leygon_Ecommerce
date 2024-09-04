<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckTipoUsuario
{
    public function handle($request, Closure $next)
    {
        // Verificar si el usuario ha iniciado sesión
        if (Auth::check()) {
            $tipo_usuario = Auth::user()->tipo_usuario;

            // Redirigir si el tipo de usuario es 0
            if ($tipo_usuario == 0) {
                return redirect()->route('home')->with('error', 'Acceso no autorizado');
            }
        } else {
            // Redirigir si el usuario no ha iniciado sesión
            return redirect()->route('home')->with('error', 'Acceso no autorizado');
        }

        // Permitir que los usuarios autenticados continúen hacia la vista de admin
        return $next($request);
    }
}
