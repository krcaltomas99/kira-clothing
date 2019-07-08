<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class Employee
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
		if(Auth::guest()) {
			return redirect()->guest("KC-admin/login");

		}else{
			if(request()->user()->role == "admin"
				|| request()->user()->role == "superadmin" || request()->user()->role == "employee"
			) {
				return $next($request);
			}else{
				return redirect()->back()->with("error", "Unauthorized");
			}
		}
	}
}
