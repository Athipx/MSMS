<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */


    // public function handle(Request $request, Closure $next, $userRole): Response
    // {
    //     if(auth()->user()->role == $userRole){
    //         return $next($request);
    //     }
    //     return redirect()->back();
    //     // return response()->json(['You do not have permission to access for this page.']);
    // }


    public function handle($request, Closure $next, ...$roles)
    {
        $user = $request->user();
        if (!$user) {
            return redirect('/login');
        }

        // Check if user has one of the allowed roles
        foreach ($roles as $role) {
            if ($user->role === $role) {
                return $next($request);
            }
        }

        return redirect()->back();
    }
}
