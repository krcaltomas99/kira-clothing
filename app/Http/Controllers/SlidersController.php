<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

class SlidersController extends Controller
{

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
	 */
	public function click(Request $request)
	{
		if ($request->ajax()) {
			$slider = Slide::findOrFail($request->input("id"));
			$slider->addClick();

			return response()->json([
				"message"=>"succes"
			]);
		}
		return back();
	}

}
