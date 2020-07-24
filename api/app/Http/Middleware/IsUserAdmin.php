<?php

namespace app\Http\Middleware;

use Closure;

class IsUserAdmin{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user()->role != "admin"){
            throw new \Exception("Looks like you are not allowed to look on this page, you noughty boy");
        }
        return $next($request);
    }
}