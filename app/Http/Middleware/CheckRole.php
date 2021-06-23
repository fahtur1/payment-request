<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role = '')
    {
        switch ($role) {
            case 'admin':
                if ($request->user('web')->role->id_role == 1) {
                    return $next($request);
                }
                break;
            case 'staff':
                if ($request->user('web')->role->id_role == 2) {
                    return $next($request);
                }
                break;
        }
        return redirect()->back();
    }
}
