<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Retrieve the authenticated user
        $user = $request->user();

        $roleName = $user->roles()->pluck('name');
        // Check if the user has any of the specified roles
        foreach ($roles as $role) {
            if ($role == $roleName[0]) {
                return $next($request);
            }
        }

        // If the user does not have any of the specified roles, redirect them to the homepage
        return redirect('/');
    }
}
