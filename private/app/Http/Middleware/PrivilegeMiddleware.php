<?php

namespace App\Http\Middleware;

use Closure;

class PrivilegeMiddleware
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
        $user = \Illuminate\Support\Facades\Auth::user();
        if ($user !== null && $user->id_privilege === 1 || $user->id_privilege === 2 ) {
            return $next($request);
        }
        return redirect(url('/'));
    }
}
