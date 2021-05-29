<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$id)
    {
        if(Auth::check()){
            return redirect()->route('/home');
        }
        // if(Auth::user()->id != $id){
        //     return redirect()->route('/home');
        // }
        // else{
        //     return $next($request);
        // }
    }
}
