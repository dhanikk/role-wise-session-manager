<?php

namespace Itpathsolutions\Sessionmanager\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class RoleBasedSessionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        Session::start();
        $user = Auth::user();
        $roles = $user->getRoleNames();
        \Log::info($roles);
        if (auth()->check()) {
            $role = auth()->user()->roles->first(); // Get the first assigned role
            if ($role) {
                if (!empty($role->session_lifetime)) {
                    Config::set('session.lifetime', $role->session_lifetime);
                }
            }
        }
        return $next($request);
    }
}
