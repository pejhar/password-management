<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

class SessionAuth
{

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $currentUser = session('user');
        if ($currentUser === null || !$this->auth->validate($currentUser)) {
            toastr()->error('Not authorized to access this page!');
            return back();
        }
        return $next($request);
    }
}
