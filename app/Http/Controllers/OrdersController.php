<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdersController extends Controller
{

	public function __construct()
	{
		$this->middleware("auth");
	}


	public function order(Request $request, $id)
	{

	}


	public function invoice(Request $request, $id)
	{

	}

}
