<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Doctor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (isset(auth()->user()->group_by)) {
            if (auth()->user()->group_by == '2') {
                return $next($request);
            }
        }
        return redirect('/')->with('error',"Only Doctor can access this.!");
    }
}
