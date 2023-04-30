<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$role)
    {

        if (auth()->check()) {
            if (auth()->user()->role->name === $role) {
                        return $next($request);
            }
            abort(404);
        }else{
            return redirect('/login');
        }
        // Redirect the user to the appropriate page based on their role
            return redirect('/login');
    }
}
