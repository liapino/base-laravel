<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoles
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
        $roles = array_slice(func_get_args(), 2);

        foreach($roles as $role)
        {
            if( auth()->user()->role->name === $role)
            {
                return $next($request);
            }
        }
        return redirect('/');
    }
}
