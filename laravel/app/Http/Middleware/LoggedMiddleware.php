<?php

namespace testmiguel\Http\Middleware;

use Closure;

use Auth;

class LoggedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){ 
            return $next($request);
        }
        //TODO append to the url some parameters to indicate what kind of action was trying to do for example access to the url
        return redirect('/login');
    }
}
