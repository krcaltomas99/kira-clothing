<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Product;

class ProductAdded
{
	use Dispatchable, InteractsWithSockets, SerializesModels;


	public $message;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 * @param string $message
	 * @param Product $product
	 */
	public function __construct($message, Product $product)
	{
		$this->product = $product;
		$this->message = $message;
	}

	/**
	 * Get the channels the event should broadcast on.
	 *
	 * @return \Illuminate\Broadcasting\Channel|array
	 */
	public function broadcastOn()
	{
		return new PrivateChannel('product-added');
	}
}
