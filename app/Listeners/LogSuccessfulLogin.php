<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Gloudemans\Shoppingcart\Facades\Cart;

class LogSuccessfulLogin
{
	/**
	 * Handle the event.
	 *
	 * @param  Login $event
	 * @return void
	 */
	public function handle(Login $event)
	{
		$user = $event->user;
		$user->last_login = date('Y-m-d H:i:s');
		$user->save();
		if (!empty($user->shoppingcart)) {
			Cart::restore($user->id);
			Cart::store($user->id);
		}
	}
}
