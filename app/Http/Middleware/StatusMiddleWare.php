<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StatusMiddleWare
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
        $user_status=auth()->user()->status;
        if($user_status == 1){
            return $next($request);
        }
        elseif($user_status == 0){
            return redirect()->back();
        }

    }
}
