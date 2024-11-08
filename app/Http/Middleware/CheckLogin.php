<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            if($request->method() == "GET") {
                return response()->json([
                    'data'=>[],
                    'status'=>0,
                    'message'=> 'authenticate fail'
                ]);
            }
            if($request->method() == "POST") {
                return response()->json([
                    'status'=>1,
                    'message'=> 'authenticate fail'
                ]);
            }

        }

        return $next($request);
    }
}
