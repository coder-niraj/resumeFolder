<?php

namespace Modules\Auth\Controllers;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EmployeeAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

        if (! Auth::guard('employee')->check()) {
            return redirect()->route('employee.login.view');
        } else {
            if (!Auth::guard('employee')->user()->status) {
                return redirect()->route('non-authorized');
            } else {
                return $next($request);
            }
        }
    }
}
