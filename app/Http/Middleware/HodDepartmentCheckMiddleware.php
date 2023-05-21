<?php

namespace App\Http\Middleware;

use App\Models\HodDepartmentAssign;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HodDepartmentCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $hod_id = Auth::user()->hod->id;
        $department_id = $request->department;
        $userExists = HodDepartmentAssign::where('hod_id', $hod_id)->where('department_id',$department_id)->exists();
        if ($userExists) return $next($request);
        else return abort('404');
    }
}
