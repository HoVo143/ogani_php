<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if(Auth::check()){
        //     $user = Auth::user();
        //     if($user->is_admin === 1){
        //         return $next($request);
        //     }else{
        //         return redirect()->route('home');
        //     }
        // }else{
        //     return redirect()->route('home');
        // }
        // return $next($request);

        if(Auth::check() && Auth::user()->is_admin ){

            return $next($request);
        }
        return redirect()->route('home');
    }
}
