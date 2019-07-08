<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\UserRegistered;
use App\Notifications\UserRegisteredNotification;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Gumlet\ImageResize;


class RegisterController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/

	use RegistersUsers;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/home';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{

		return Validator::make($data, [
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6|confirmed',
			'avatar-file' => 'image|max:1000'
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array $data
	 * @return \App\User
	 * @throws \Gumlet\ImageResizeException
	 */
	protected function create(array $data)
	{
		$fileNameToStore = "user.png";
		$request = request();

		if ($request->hasFile("avatar-file")) {
			$widthToResize = 100;
			//actual instance of the image
			$image = $request->file("avatar-file");
			//Get filename with the extension
			$filenameWithExt = $image->getClientOriginalName();
			//Get just file name
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			//Get just extension
			$ext = $image->getClientOriginalExtension();
			//Filename to store
			$fileNameToStore = $filename . "_" . time() . "." . $ext;

			//public path
			$path = "storage/userAvatars/" . $fileNameToStore;
			$img_resize = new ImageResize($image->getRealPath());
			$img_resize->resizeToWidth($widthToResize);
			$img_resize->save($path);
		}

		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => Hash::make($data['password']),
			'role' => 'customer',
			'avatar' => $fileNameToStore,
		]);
	}

	protected function registered(Request $request, $user)
	{
		$user->notify(new UserRegisteredNotification($user));
		$me = User::where("email", "krcaltomas99@gmail.com")->first();
		$me->notify(new UserRegistered($user));
	}

}
