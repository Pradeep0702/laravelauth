<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::guard('login')->check()){
            session()->flash('type','error');
            session()->flash('message','Please Login Your Account');
            return redirect()->route('front.index');
        }
        return $next($request);
    }
}
