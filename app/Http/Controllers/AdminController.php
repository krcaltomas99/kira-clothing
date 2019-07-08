<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

	public function __construct()
	{
		$this->middleware('employee')->only('index');
		$this->middleware('guest')->only('login');
	}


	/**
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view("admin.index");
	}


	/**
	 * @return \Illuminate\Http\Response
	 */
	public function login()
	{
		return view("admin.login");
	}

}
