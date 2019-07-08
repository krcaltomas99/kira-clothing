<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Product;
use Illuminate\Support\Facades\Input;

class SectionsController extends Controller
{

	private $pagination_limit = 20;

	public function show(string $slug)
	{
		$section = Section::where("slug", $slug)->first();
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


		if (!$section) {
			return abort(404);
		}

		if (!$sort || !in_array($sort, $allowedSort)) {
			$sort = "most-popular";
		}

		$productsToMerge = Product::join("sections", "products.section_id", "=", "sections.id")->where("sections.id", $section->id);

		if ($section->children) {
			foreach ($section->children as $item) {
				$productsToMerge->orWhere("sections.id", "=", $item->id);
			}
		}


		switch ($sort) {
			case "most-popular":
				{
					$productsToMerge->orderBy("products.sold");
				}
				break;
			case "highest-price":
				{
					$productsToMerge->orderByRaw("cast(products.price as unsigned) desc");
				}
				break;
			case "lowest-price":
				{
					$productsToMerge->orderByRaw("cast(products.price as unsigned) asc");
				}
				break;
			case "a-z":
				{
					$productsToMerge->orderBy("products.name", "asc");
				}
				break;
			case "z-a":
				{
					$productsToMerge->orderBy("products.name", "desc");
				}
				break;
			default:
				{
					$productsToMerge->orderBy("products.created_at", "desc");
				}
		}


		$products = $productsToMerge->select("products.*")->paginate($this->pagination_limit);

		return view("productsCategories", compact("products", "section", "select"));
	}


	public function filter(Request $request)
	{
		if (!$request->ajax()) {
			return response()->json(["success" => false]);
		}

		$section = Section::where("slug", $request->input("slug"))->first();
		$sort = Input::get("sort");
		$allowedSort = [
			"most-popular",
			"highest-price",
			"lowest-price",
			"a-z",
			"z-a",
		];

		if (!$sort || !in_array($sort, $allowedSort)) {
			$sort = "most-popular";
		}

		$productsToMerge = Product::join("sections", "products.section_id", "=", "sections.id")->where("sections.id", $section->id);

		if ($section->children) {
			foreach ($section->children as $item) {
				$productsToMerge->orWhere("sections.id", "=", $item->id);
			}
		}


		switch ($sort) {
			case "most-popular":
				{
					$productsToMerge->orderBy("products.sold");
				}
				break;
			case "highest-price":
				{
					$productsToMerge->orderByRaw("cast(products.price as unsigned) desc");
				}
				break;
			case "lowest-price":
				{
					$productsToMerge->orderByRaw("cast(products.price as unsigned) asc");
				}
				break;
			case "a-z":
				{
					$productsToMerge->orderBy("products.name", "asc");
				}
				break;
			case "z-a":
				{
					$productsToMerge->orderBy("products.name", "desc");
				}
				break;
			default:
				{
					$productsToMerge->orderBy("products.created_at", "desc");
				}
		}


		$products = $productsToMerge->select("products.*")->paginate($this->pagination_limit);

		return response()->json([
			"products" => $products
		]);
	}

}
