<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role  The role required to access the route
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // if (Auth::check()) {
        //     foreach ($roles as $role) {
        //         // If the user has one of the roles, allow the request to proceed
        //         if (Auth::user()->role === $role) {
        //             return $next($request);
        //         }
        //     }
        // }
        
        // If the user is not authenticated or doesn't have any of the roles, redirect them
        // return redirect('/books');
        // return redirect('auth.login');

        // If there are no roles provided, or if the user is a guest, proceed with the next request.
            if (empty($roles) || !Auth::check()) {
                return $next($request);
            }

            // If the user does not have any of the roles, redirect them.
            if (!in_array(Auth::user()->role, $roles)) {
                // You might want to redirect to a different route or show an error page
                // depending on your application's requirements.
                // For example, you could redirect to a '403 Forbidden' page, or to a page that explains the user lacks permission.
                return redirect('/forbidden'); // This is a hypothetical route for the sake of example
            }

            // User is authenticated and has one of the roles, so proceed with the request.
            return $next($request);
    }



}

