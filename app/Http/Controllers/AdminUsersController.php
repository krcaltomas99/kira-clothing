<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Gumlet\ImageResize;

class AdminUsersController extends Controller
{

	public function __construct()
	{
		$this->middleware('employee', ['only' => ['clients', 'employees', 'users']]);
		$this->middleware('superadmin', ['only' => ['destroy', 'edit', 'update']]);
	}


	public function customers(Request $request)
	{
		$allowedSorts = ["id", "name", "created_at", "last_login", "email"];
		$allowedOrder = ["asc", "desc", "ASC", "DESC"];
		$sort = Input::get("sort");
		$order = Input::get("order");
		$search = Input::get("q");

		if (!$sort) {
			$sort = "id";
		}
		if (!$order) {
			$order = "desc";
		}

		if (!in_array($order, $allowedOrder)) {
			$request->session()->flash("error", "Order not allowed");
			return back();
		}
		if (!in_array($sort, $allowedSorts)) {
			$request->session()->flash("error", "Sort not allowed");
			return back();
		}
		$customers = User::orderBy($sort, $order);

		if ($search) {
			$customers = $customers->where("name", "LIKE", "%{$search}%");
		}
		$customers = $customers->where("role", "=", "customer")->paginate(20);

		return view("admin.users.customers")->with("customers", $customers);
	}


	public function employees(Request $request)
	{
		$allowedSorts = ["id", "name", "created_at", "last_login", "email"];
		$allowedOrder = ["asc", "desc", "ASC", "DESC"];
		$sort = Input::get("sort");
		$order = Input::get("order");
		$search = Input::get("q");

		if (!$sort) {
			$sort = "id";
		}
		if (!$order) {
			$order = "desc";
		}

		if (!in_array($order, $allowedOrder)) {
			$request->session()->flash("error", "Order not allowed");
			return back();
		}
		if (!in_array($sort, $allowedSorts)) {
			$request->session()->flash("error", "Sort not allowed");
			return back();
		}
		$employees = User::orderBy($sort, $order);

		if ($search) {
			$employees = $employees->where("name", "LIKE", "%{$search}%");
		}
		$employees = $employees->where("role", "!=", "customer")->paginate(20);

		return view("admin.users.employees")->with("employees", $employees);
	}


	public function users(Request $request)
	{
		$allowedSorts = ["id", "name", "created_at", "last_login", "email", "role"];
		$allowedOrder = ["asc", "desc", "ASC", "DESC"];
		$sort = Input::get("sort");
		$order = Input::get("order");
		$search = Input::get("q");

		if (!$sort) {
			$sort = "id";
		}
		if (!$order) {
			$order = "desc";
		}

		if (!in_array($order, $allowedOrder)) {
			$request->session()->flash("error", "Order not allowed");
			return back();
		}
		if (!in_array($sort, $allowedSorts)) {
			$request->session()->flash("error", "Sort not allowed");
			return back();
		}
		$users = User::orderBy($sort, $order);

		if ($search) {
			$users = $users->where("name", "LIKE", "%{$search}%");
		}
		$users = $users->paginate(20);

		return view("admin.users.users")->with("users", $users);
	}


	public function edit($id)
	{
		$user = User::findOrFail($id);

		return view("admin.users.edit")->with("user", $user);
	}


	/**
	 * @param Request $request
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Gumlet\ImageResizeException
	 */
	public function update(Request $request, $id)
	{
		$user = User::findOrFail($id);

		$this->validate($request, [
			"name" => "required",
			"email" => "required",
			"role" => "required",
			"avatar-file" => "image|max:2000"
		]);

		if ($request->hasFile("avatar-file")) {
			$widthToResize = 100;
			$image = $request->file("avatar-file");
			$filenameWithExt = $image->getClientOriginalName();
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			$ext = $image->getClientOriginalExtension();
			$fileNameToStore = $filename . "_" . time() . "." . $ext;
			//Upload
			$path = "storage/userAvatars/" . $fileNameToStore;
			$img_resize = new ImageResize($image->getRealPath());
			$img_resize->resizeToWidth($widthToResize);

			if (!$user->isDefault() && !$user->isAvatarSocial()) {
				Storage::delete("public/userAvatars/" . $user->avatar);
			}

			$user->avatar = $fileNameToStore;
			$img_resize->save($path);
		}

		$user->name = $request->input("name");
		$user->email = $request->input("email");
		$user->role = $request->input("role");

		$user->save();

		return back()->with("success", "Successfully updated");

	}


	public function destroy($id)
	{

	}

}
