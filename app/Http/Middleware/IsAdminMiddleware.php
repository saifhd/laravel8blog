<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   $is_admin=auth()->user()->is_admin;
        if($is_admin == 1){
            return $next($request);
        }
        else{
            return redirect()->back();
        }

    }
}
