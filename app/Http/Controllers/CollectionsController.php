<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collection;
use App\Product;
use Illuminate\Support\Facades\Input;

class CollectionsController extends Controller
{

	private $pagination_limit = 20;


	public function show(string $slug)
	{
		$collection = Collection::where("slug", $slug)->first();
		$sort = Input::get("sort");
		$allowedSort = [
			"most-popular",
			"highest-price",
			"lowest-price",
			"a-z",
			"z-a",
		];
		$select = [
			"most-popular" => "Most Popular",
			"highest-price" => "Highest Price",
			"lowest-price" => "Lowest Price",
			"a-z" => "A-Z",
			"z-a" => "Z-A",
		];


		if (!$collection) {
			return abort(404);
		}

		if (!$sort || !in_array($sort, $allowedSort)) {
			$sort = "most-popular";
		}

		$products = Product::join("collections", "products.collection_id", "=", "collections.id")->where("collections.id", $collection->id);

		switch ($sort) {
			case "most-popular":
				{
					$products->orderBy("products.sold");
				}
				break;
			case "highest-price":
				{
					$products->orderByRaw("cast(products.price as unsigned) desc");
				}
				break;
			case "lowest-price":
				{
					$products->orderByRaw("cast(products.price as unsigned) asc");
				}
				break;
			case "a-z":
				{
					$products->orderBy("products.name", "asc");
				}
				break;
			case "z-a":
				{
					$products->orderBy("products.name", "desc");
				}
				break;
			default:
				{
					$products->orderBy("products.created_at", "desc");
				}
		}

		$products = $products->select("products.*")->paginate($this->pagination_limit);


		return view("products", compact("products", "collection", "select"));
	}


	public function filter(Request $request)
	{
		if (!$request->ajax()) {
			return response()->json(["success" => false]);
		}
		$collection = Collection::where("slug", $request->input("slug"))->first();
		$sort = Input::get("sort");
		$allowedSort = [
			"most-popular",
			"highest-price",
			"lowest-price",
			"a-z",
			"z-a",
		];

		if (!$collection) {
			return abort(404);
		}

		if (!$sort || !in_array($sort, $allowedSort)) {
			$sort = "most-popular";
		}

		$products = Product::join("collections", "products.collection_id", "=", "collections.id")->where("collections.id", $collection->id);

		switch ($sort) {
			case "most-popular":
				{
					$products->orderBy("products.sold");
				}
				break;
			case "highest-price":
				{
					$products->orderByRaw("cast(products.price as unsigned) desc");
				}
				break;
			case "lowest-price":
				{
					$products->orderByRaw("cast(products.price as unsigned) asc");
				}
				break;
			case "a-z":
				{
					$products->orderBy("products.name", "asc");
				}
				break;
			case "z-a":
				{
					$products->orderBy("products.name", "desc");
				}
				break;
			default:
				{
					$products->orderBy("products.created_at", "desc");
				}
		}

		$products = $products->select("products.*")->paginate($this->pagination_limit);


		return response()->json([
			"products" => $products
		]);
	}


	public function click(Request $request)
	{
		$collection = Collection::findOrFail($request->input("id"));
		$collection->addClick();
	}

}
