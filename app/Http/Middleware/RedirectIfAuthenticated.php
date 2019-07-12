<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\User;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'api')
    {
        dd(Auth::guard($guard)->check());
        if (!Auth::check()) {
            return redirect('/login.html');
        }
        $id = Auth::user()->id;
        if (!User::find($id)->getCustomer) {
            return redirect('/login.html');
        }
        return $next($request);
    }
}
