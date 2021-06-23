<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsurePosition
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $position = '')
    {
        $namaPosisi = strtolower($request->user('web')->position->nama_position);

        switch (strtolower($position)) {
            case 'media':
                if ($namaPosisi == 'media') {
                    return $next($request);
                }
                break;
        }
        return redirect()->back();
    }
}
