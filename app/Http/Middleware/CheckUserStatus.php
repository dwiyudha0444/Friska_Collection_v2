<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response)  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->status == 'nonaktif') {
                return response()->view('waiting');
            }
        } else {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }
    
        return $next($request);
    }
    
}

