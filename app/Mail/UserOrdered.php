<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Order;

class UserOrdered extends Mailable
{
	use Queueable, SerializesModels;

	/**
	 * The order instance.
	 *
	 * @var Order
	 */
	public $order;

	/**
	 * Create a new message instance.
	 *
	 * @param Order $order
	 * @return void
	 */
	public function __construct(Order $order)
	{
		$this->order = $order;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->from(env("MAIL_FROM_ADDRESS2"))
			->subject("Thank you! The order#" . $this->order->id . " has been confirmed")
			->markdown('emails.ordered');
	}
}
