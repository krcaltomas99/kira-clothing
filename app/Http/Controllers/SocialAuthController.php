<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Response;
use App\SocialAccount;
use App\User;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAuthController extends Controller
{

	public function __construct()
	{
		$this->middleware('guest');
	}


	/**
	 * Redirect the user to the OAuth Provider.
	 *
	 * @return Response
	 * @param  $provider
	 */
	public function redirectToProvider($provider)
	{
		session(['adminauth' => false]);
		return Socialite::driver($provider)->redirect();
	}

	public function redirectToAdminProvider()
	{
		session(['adminauth' => true]);
		return Socialite::driver('google')->redirect();
	}


	/**
	 * Obtain the user information from provider.  Check if the user already exists in our
	 * database by looking up their provider_id in the database.
	 * If the user exists, log them in. Otherwise, create a new user then log them in. After that
	 * redirect them to the authenticated users homepage.
	 *
	 * @return Response
	 * @param $provider
	 */
	public function handleProviderCallback($provider)
	{
		$user = Socialite::driver($provider)->user();

		if (session("adminauth")) {
			$authUser = $this->findUser($user);
			if ($authUser && $authUser->role !== "customer") {
				auth()->login($authUser);
				return redirect()->intended();
			}
			return redirect("/KC-admin/login")->with("error", "Unauthorized");
		}

		$authUser = $this->findOrCreateUser($user, $provider);
		auth()->login($authUser);
		return redirect()->intended();
	}

	/**
	 * If a user has registered before using social auth, return the user
	 * else, create a new user object.
	 * @param  ProviderUser $providerUser
	 * @param $provider Social auth provider
	 * @return User
	 */
	public function findOrCreateUser(ProviderUser $providerUser, $provider)
	{

		$account = SocialAccount::whereProvider($provider)
			->whereProviderUserId($providerUser->getId())
			->first();

		if ($account) {
			return $account->user;
		} else {

			$account = new SocialAccount([
				'provider_user_id' => $providerUser->getId(),
				'provider' => $provider
			]);

			$user = User::whereEmail($providerUser->getEmail())->first();

			if (!$user) {

				$user = User::create([
					'email' => $providerUser->getEmail(),
					'name' => $providerUser->getName(),
					'password' => md5(rand(1, 10000)),
					'avatar' => $providerUser->getAvatar(),
					'role' => 'customer'
				]);
			}

			$account->user()->associate($user);
			$account->save();

			return $user;
		}
	}

	public function findUser(ProviderUser $providerUser)
	{
		$account = SocialAccount::whereProvider('google')
			->whereProviderUserId($providerUser->getId())
			->first();

		if ($account) {
			return $account->user;
		}
		return NULL;
	}
}
