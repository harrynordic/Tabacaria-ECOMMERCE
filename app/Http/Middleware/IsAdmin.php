<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Importe a fachada Auth

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se o usuário está logado E se o usuário logado tem a propriedade is_admin como true
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request); // Se for admin, continua para a rota
        }

        // Se não for admin ou não estiver logado, redireciona.
        // Você pode redirecionar para uma página de erro, home, ou login.
        return redirect('/')->with('error', 'Acesso não autorizado para o painel de administração.');
        // Ou, para login: return redirect('/login')->with('error', 'Você não tem permissão para acessar esta área.');
    }
}