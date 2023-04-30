<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if(!auth()->guest()){
            $userRole = $request->user()->role;
            if($userRole == $role ||$userRole == 'admin'){
                return $next($request);
            }
            if($role == 'allAdmin' && $userRole != 'user'){
                return $next($request);
            }
            abort(403);
        }

        return redirect()->route('login');
    }
}
