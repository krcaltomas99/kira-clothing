<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Gloudemans\Shoppingcart\Facades\Cart;

class UserLoggedOut
{
	/**
	 * Handle the event.
	 *
	 * @param  Logout $event
	 * @return void
	 */
	public function handle(Logout $event)
	{
		$user = $event->user;
		if (Cart::count() > 0) {
			if (!empty($user->shoppingcart)) {
				$user->shoppingcart()->delete();
			}
			Cart::store($user->id);
		}
	}
}
