<?php

namespace App\Http\Middleware;


use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class SuperAdmin
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
		if (Auth::guest()) {
			return redirect()->guest("KC-admin/login");

		} else {
			if (request()->user()->role == "superadmin") {
				return $next($request);
			} else {
				return redirect()->back()->with("error", "Unauthorized");
			}
		}
	}
}
