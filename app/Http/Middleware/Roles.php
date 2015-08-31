<?php

namespace App\Http\Middleware;

use Closure;

class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
	public function handle($request, Closure $next, $role)
	{
		if (!$request->user()->hasRole($role))
		{
			return redirect('auth/login')
				->withErrors([
					'name' => 'Usted no posee los privilegios nesesarios para entrar a este módulo.',
					'password' => 'Debe ingresar como otro usuario con mas privilegios o llamar al administrador del sistema.'
				]);
		}

		return $next($request);
	}
}
