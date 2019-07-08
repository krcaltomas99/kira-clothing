<?php

namespace App\Http\Controllers;

use App\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Gumlet\ImageResize;

use App\User;

class UsersController extends Controller
{

	public function __construct()
	{
		$this->middleware("auth");
	}

	public function index()
	{
		$user = Auth::user();

		return view("users.index", compact("user"));
	}


	public function pass()
	{
		$user = Auth::user();

		return view("users.password", compact("user"));
	}


	public function shipping()
	{
		$user = Auth::user();

		return view("users.shipping", compact("user"));
	}


	public function orders()
	{
		$user = Auth::user();

		return view("users.order", compact("user"));
	}


	/**
	 * @param Request $request
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Gumlet\ImageResizeException
	 */
	public function update(Request $request, int $id)
	{
		$user = User::findOrFail($id);
		$userAuth = Auth::user();

		$request->validate([
			"name" => "required|string",
			"email" => [
				"required",
				"string",
				"email",
				Rule::unique('users')->ignore($user->id),
			]
		]);

		if ($user->id !== $userAuth->id) return back()->with("error", "You are not allowed to do that");

		if ($request->hasFile("cover_image")) {
			$request->validate([
				"cover_image" => "image|max:2000"
			]);

			$widthToResize = 100;
			//actual instance of the image
			$image = $request->file("cover_image");
			//Get filename with the extension
			$filenameWithExt = $image->getClientOriginalName();
			//Get just file name
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			//Get just extension
			$ext = $image->getClientOriginalExtension();
			//Filename to store
			$fileNameToStore = $filename . "_" . time() . "." . $ext;

			if (!$user->isDefault() && !$user->isAvatarSocial()) {
				Storage::delete("public/userAvatars/" . $user->avatar);
			}

			//public path
			$path = "storage/userAvatars/" . $fileNameToStore;
			$img_resize = new ImageResize($image->getRealPath());
			$img_resize->resizeToWidth($widthToResize);
			$img_resize->save($path);
			$user->avatar = $fileNameToStore;
		}

		$user->email = $request->input("email");
		$user->name = $request->input("name");
		$user->save();

		return redirect()->route("users.index")->with("success", "Your profile has been updated");
	}


	public function updatePass(Request $request, int $id)
	{
		$request->validate([
			"old_pass" => "required|string",
			"new_pass" => "required|string|min:6",
			"new_pass_check" => "required|string|min:6"
		]);

		$user = User::find($id);

		if (!Hash::check($request->input("old_pass"), $user->password)) {
			return back()->withInput()->withErrors(["old_pass" => "Old password doesn't match"]);
		}

		if ($request->input("new_pass") === $request->input("new_pass_check")) {
			$request->user()->fill([
				'password' => Hash::make($request->input("new_pass"))
			])->save();

			return redirect()->route("users.pass")->with("success", "The password has been changed");
		}

		return back()->with("error", "The passwords don't match");
	}


	public function updateShipping(Request $request, int $id)
	{
		$user = User::findOrFail($id);

		$request->validate([
			"city" => "required|string",
			"address" => "required|string",
			"country" => "required",
			"psc" => "required",
			"tel" => "nullable|string"
		]);

		$user->shipping_address->city = $request->input("city");
		$user->shipping_address->address = $request->input("address");
		$user->shipping_address->country_code = $request->input("country");
		$user->shipping_address->state = $request->input("state");
		$user->shipping_address->postal_code = $request->input("psc");
		$user->shipping_address->phone = $request->input("tel");
		$user->shipping_address->user_id = $user->id;
		$user->shipping_address->save();

		return redirect()->route("users.shipping")->with("success", "The shipping address has been updated");
	}


	public function storeShipping(Request $request)
	{
		$user = $request->user();

		$request->validate([
			"city" => "required|string",
			"address" => "required|string",
			"country" => "required",
			"psc" => "required",
			"tel" => "nullable|string"
		]);

		$shipping_address = new ShippingAddress;
		$shipping_address->city = $request->input("city");
		$shipping_address->address = $request->input("address");
		$shipping_address->country_code = $request->input("country");
		$shipping_address->state = $request->input("state");
		$shipping_address->postal_code = $request->input("psc");
		$shipping_address->phone = $request->input("tel");
		$shipping_address->user_id = $user->id;
		$shipping_address->save();

		return redirect()->route("users.shipping")->with("success", "Your shipping address has been saved");
	}

	/**
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function changeToDefault($id)
	{
		$userAuth = Auth::user();
		$user = User::findOrFail($id);

		if ($userAuth && $userAuth->id === $user->id) {
			if ($userAuth->isDefault()) {
				return redirect()->route("users.index")->with("warning", "Your avatar is already default");
			}

			if (!$userAuth->isAvatarSocial()) {
				Storage::delete("public/userAvatars/" . $userAuth->avatar);
			}

			$userAuth->makeDefaultAvatar();
		}

		return redirect()->route("users.index")->with("success", "The avatar has been changed to default");
	}

}
