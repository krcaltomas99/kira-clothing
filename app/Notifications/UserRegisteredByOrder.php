<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\User;

class UserRegisteredByOrder extends Notification
{
	use Queueable;

	/**
	 * UserRegisteredByOrder constructor.
	 * @param User $user
	 * @param $password
	 */
	public function __construct(User $user, $password)
	{
		$this->user = $user;
		$this->password = $password;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed $notifiable
	 * @return array
	 */
	public function via($notifiable)
	{
		return ['mail'];
	}

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param  mixed $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable)
	{
		return (new MailMessage)
			->success()
			->subject("You've just been registered to Kira Clothing.")
			->line("Hello " . $this->user->name . ",")
			->line("First of all, thank you for the purchase you've just made,
			 we really appreciate it! Next we'd like to tell you that you've just been registered on our site! If you don't
			 want the account you don't have to do anything, and the next time you order something you won't receive this email.")
			->line("But if you try some of the benefits of having an account on our site,
			 we have generated a save password and you can login using your email and password")
			->line("e-mail: " . $this->user->email)
			->line("password: " . $this->password)
			->line("We recommend changing the password as soon as possible in the user settings.")
			->line("Have a beautiful day. Kira Clothing")
			->action("Log in", route("login"));
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param  mixed $notifiable
	 * @return array
	 */
	public function toArray($notifiable)
	{
		return [
			//
		];
	}
}
