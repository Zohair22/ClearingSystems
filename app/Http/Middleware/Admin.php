<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (isset(auth()->user()->group_by)) {
            if (auth()->user()->group_by == '1') {
                return $next($request);
            }
        }
        return redirect('/')->with('error',"Only Administrator can access this.!");
    }
}
