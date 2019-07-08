<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use App\Product;
use App\Collection;

class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 * @return void
	 */
	public function __construct()
	{

	}


	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$slides = Slide::where("active", 1)->orderBy("position", "asc")->inRandomOrder()->take(5)->get();
		$newestProducts = Product::where("sku_id", "=", NULL)->orderBy("created_at", "DESC")->take(8)->get();
		$hottestcollection = Collection::orderBy("clicks", "DESC")->take(1)->get();
		$randomcollections = Collection::where("id", "!=", $hottestcollection[0]->id)->inRandomOrder()->take(2)->get();
		$collections = $randomcollections->merge($hottestcollection);
		$hottestProducts = Product::orderBy("sold", "desc")->take(10)->get();

		return view('home', compact("slides", "newestProducts", "collections", "hottestProducts"));
	}


	public function loadmoreproducts(Request $request, int $offset)
	{
		if ($request->ajax()) {
			$productCount = 8;
			$productsArray = [];
			$products = Product::where("sku_id", "=", NULL)->orderBy("id", "desc")->offset($offset)->limit($productCount)->get();

			foreach ($products as $key => $product) {
				array_push($productsArray, $product);
				$productsArray[$key]["children"];
			}
			$moreproducts = count(Product::where("sku_id", "=", NULL)->orderBy("id", "desc")->offset($offset + $productCount)->limit($productCount)->get()) > 0 ? true : false;

			return response()->json([
				"products" => $productsArray,
				"more" => $moreproducts,
			]);
		}

		return redirect()->back();
	}
}
