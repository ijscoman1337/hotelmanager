<?php

namespace app\Http\Middleware;

use Closure;

class IsUserCustomer{

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        if($request->user()->role != "customer"){
            throw new \Exception("Looks like you are not allowed to look on this page, you noughty boy");
        }

        return $next($request);
    }
}