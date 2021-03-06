<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;

class CheckIsParticipant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() == null) {
            return redirect(route('events.index'));
        } else {
        }
        $role = Auth::user()->role;
        if (Auth::check()) {
            if ($role == "participant") {
                return $next($request);
            } else {
                return redirect(route('events.index'));
            }
        } else {
            return redirect(route('events.index'));
        }
    }

}
