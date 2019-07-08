<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Product;
use App\ProductRating;
use App\Section;
use App\Tag;
use App\UserColor;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ProductsController extends Controller
{

	private $pagination_limit = 4;


	public function __construct()
	{
		$this->middleware("auth")->only(["addToRecommended"]);
	}

	public function search(Request $request)
	{
		$searched = $request->input("q");
		if ($searched) {
			session(["q" => $searched]);
		}
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

		if (!$sort || !in_array($sort, $allowedSort)) {
			$sort = "most-popular";
		}
		$products = Product::where("name", "LIKE", "%" . session("q") . "%");

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

		return view("productsFilter", compact("products", "select"));
	}


	public function emptySearch()
	{
		session()->forget("q");

		return response()->json(["success" => true]);
	}


	public function filter(Request $request)
	{
		if (!$request->ajax()) {
			return response()->json(["success" => false]);
		}

		$sort = Input::get("sort");
		$searched = Input::get("q");
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
		$products = Product::where("name", "LIKE", "%$searched%");

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


	public function ajaxsearch(Request $request)
	{
		$searched = $request->input("q");
		$products = Product::where("name", "LIKE", "%$searched%")->get();
		$categories = Section::where("name", "LIKE", "%$searched%")->get();
		$collections = Collection::where("name", "LIKE", "%$searched%")->get();
		$tag = Tag::where("name", "LIKE", "%$searched%")->first();

		if (!$products) {
			return response()->json(["success" => false]);
		}

		$productsArray = [];
		$tagArray = [];

		foreach ($products as $key => $product) {
			array_push($productsArray, $product);
			$productsArray[$key]["sectionName"] = $product->section->name;
		}

		if ($tag) {
			foreach ($tag->products as $key => $tagproduct) {
				array_push($tagArray, $tagproduct);
				$tagArray[$key]["sectionName"] = $tagproduct->section->name;
			}
		}


		return response()->json([
			"products" => $productsArray,
			"categories" => $categories,
			"collections" => $collections,
			"tagproducts" => $tagArray,
			"tag" => $tag
		]);
	}


	/**
	 * @param $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$product = Product::findOrFail($id);
		if (!$product) {
			return abort(404)->with("product", $product);
		}
		$displayRate = false;
		$ratingValue = 0;
		$key = 1;
		$productImages = Product::join("product_images", "products.id", "=", "product_images.product_id")
			->where("products.id", "=", $product->id)
			->orderBy("product_images.position", "asc")
			->select("product_images.*")
			->get();
		$groupedProducts = Product::whereNotNull("group_id")->where("group_id", $product->group_id)->where("id", "!=", $product->id)->get();

		foreach ($product->ratings as $key => $rating) {
			$ratingValue += $rating->rating;
		}

		if (Auth::check()) {
			foreach (Auth::user()->orders as $order) {
				foreach ($order->products as $orderProduct) {
					if ($product->id === $orderProduct->product_id) {
						$displayRate = true;
						foreach ($product->ratings as $rating) {
							if ($rating->user_id === Auth::user()->id) {
								$displayRate = false;
								break 3;
							}
						}
					}
				}
			}
		}

		$ratingValue = number_format($ratingValue / ($key + 1), "1");

		return view("product", compact("product", "groupedProducts", "productImages", "ratingValue", "displayRate"));
	}


	public function rate(Request $request)
	{
		if (Auth::check() && $request->ajax()) {
			$user = Auth::user();
			$value = $request->input("value");
			$id = $request->input("id");
			$product = Product::findOrFail($id);
			$ratingValue = 0;
			$key = 1;

			$rating = new ProductRating;
			$rating->user_id = $user->id;
			$rating->product_id = $id;
			$rating->rating = $value;

			if ($rating->save()) {
				foreach ($product->ratings as $key => $rating) {
					$ratingValue += $rating->rating;
				}

				$ratingValue = number_format($ratingValue / ($key + 1), "1");

				return response()->json([
					"success" => true,
					"rating" => $ratingValue
				]);
			}

			return response()->json(["success" => false]);
		}
	}


	public function addProductToFavorites(Request $request)
	{
		$user = Auth::user();
		if ($request->ajax()) {
			if (Auth::check()) {
				if ($user->favoriteproducts->contains($request->id)) {
					$user->removeFromFavorites($request->id);
					return response()->json([
						"message" => "The product has been removed to favorites",
						"count" => $user->favoriteproducts()->count(),
						"success" => true,
						"added" => false,
					]);
				}
				$user->addToFavorites($request->id);
				return response()->json([
					"message" => "The product has been added to favorites",
					"count" => $user->favoriteproducts()->count(),
					"success" => true,
					"added" => true,
				]);
			}
			return response()->json([
				"success" => false,
				"productId" => $request->id
			]);
		}

		return redirect()->back();
	}


	public function getFavorites(Request $request)
	{
		if ($request->ajax()) {
			$products = [];
			if (Auth::check()) {
				$favorites = Auth::user()->favoriteproducts;
				if ($favorites->isEmpty()) {
					return response()->json([
						"message" => "No favorites",
						"success" => false
					]);
				}
				foreach ($favorites as $key => $product) {
					array_push($products, $product);
					$products[$key]["sectionName"] = $product->section->name;
				}
				return response()->json([
					"products" => $favorites,
					"success" => true
				]);

			} else {
				if ($request->has("ids")) {
					$productIds = json_decode($request->input("ids"), true);
					foreach ($productIds["id"] as $key => $productId) {
						$product = Product::findOrFail($productId);
						if ($product) {
							array_push($products, $product);
							$products[$key]["sectionName"] = $product->section->name;
						}
					}

					if (empty($products)) {
						return response()->json([
							"message" => "No favorites",
							"success" => false,
						]);
					}

					return response()->json([
						"products" => $products,
						"success" => true,
					]);
				}

				return response()->json([
					"message" => "No favorites",
					"success" => false,
				]);
			}
		}

		return back()->with("error", "Unauthorized");
	}


	public function getCart(Request $request)
	{
		if ($request->ajax()) {
			if (Cart::count() > 0) {
				$products = [];
				$counter = 0;
				foreach (Cart::content() as $key => $item) {
					array_push($products, $item->model);
					$products[$counter]["qty"] = intval($item->qty);
					$products[$counter]["sectionName"] = $item->model->section->name;
					$products[$counter]["chosenSize"] = $item->model->getSizeNameBySizeId($item->options->size);
					$products[$counter]["rowId"] = $item->rowId;
					$counter++;
				}
				return response()->json([
					"products" => $products,
					"success" => true
				]);

			}

			return response()->json([
				"message" => "Empty basket",
				"success" => false
			]);
		}

		return back()->with("error", "Unauthorized");
	}


	public function getLastVisited(Request $request)
	{
		$products = [];
		if ($request->ajax()) {
			if ($request->has("ids")) {
				$productIds = json_decode($request->input("ids"), true);
				foreach ($productIds["id"] as $key => $productId) {
					$product = Product::findOrFail($productId);
					if ($product) {
						array_push($products, $product);
					}
				}

				if (empty($products)) {
					return response()->json([
						"message" => "No last visited",
						"success" => false,
					]);
				}

				return response()->json([
					"products" => $products,
					"success" => true,
				]);
			}
		}

		return back()->with("error", "Unauthorized");
	}


	public function addToRecommended(Request $request)
	{
		$color = $request->input("color");
		$user = Auth::user();

		foreach ($user->favorite_colors as $favorite_color) {
			if ($favorite_color->value === $color) return response()->json(["success" => false]);
		}

		if ($user->favorite_colors->count() > 2) {
			$user->favorite_colors()->first()->delete();
		}

		$userColor = new UserColor;
		$userColor->user_id = $user->id;
		$userColor->value = $color;
		$userColor->save();

		return response()->json(["success" => true]);
	}


	public function getRecommended()
	{
		$user = Auth::user();
		$products = Product::inRandomOrder()->take(40)->get();
		$productsArray = [];
		$colorsArray = [];

		foreach ($products as $key => $product) {
			array_push($productsArray, $product);
			$productsArray[$key]["color"];
		}

		if (Auth::check()) {

			foreach ($user->favorite_colors as $favorite_color) {
				array_push($colorsArray, $favorite_color->value);
			}

			return response()->json([
				"colors" => $colorsArray,
				"products" => $productsArray
			]);
		}

		return response()->json([
			"products" => $productsArray
		]);
	}

}
