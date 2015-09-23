<?php

namespace App\Http\Middleware;

use Closure;

class AuthType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
	public function handle($request, Closure $next, $type)
	{
		if ($request->user()->type > $type)
		{
			return redirect('auth/login')
				->withErrors([
					'name' => 'Usted no posee los privilegios necesarios para entrar a este módulo.',
					'password' => 'Debe ingresar como otro usuario con mas privilegios o llamar al administrador del sistema.'
				]);
		}

		return $next($request);
	}
}
