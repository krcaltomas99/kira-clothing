<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

use Illuminate\Http\Request;


class SystemController extends Controller
{

	public function __construct()
	{
		$this->middleware("superadmin")->except("privacypolicy");
	}


	public function migrate()
	{
		Artisan::call("migrate");
		return redirect()->route("admin.index")->with("success", "Migration was completed");
	}


	public function rollback()
	{
		Artisan::call("migrate:rollback");
		return redirect()->route("admin.index")->with("success", "Database was rolled back");
	}


	public function privacypolicy()
	{
		return view("privacypolicy");
	}

}
