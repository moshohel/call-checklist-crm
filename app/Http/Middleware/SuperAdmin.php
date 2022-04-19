<?php

namespace App\Http\Middleware;

use Closure;

class SuperAdmin
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
        $user = auth()->user();

        if(!$user) return redirect()->route('login');

        if (($user->user_level == 9) && ($user->user_group == 'ADMIN') ) {
            return $next($request);
        }
        return response()->json('You Need to be super Admin');
    }
}
