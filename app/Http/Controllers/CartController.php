<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Section;

class CartController extends Controller
{

	public function index()
	{
		$section = Section::inRandomOrder()->first();
		return view("cart.index", compact("section"));
	}


	public function store(Request $request, int $id)
	{
		$product = Product::find($id);
		$sizeId = intval($request->input("size"));

		foreach ($product->quantities as $qty) {
			if ($qty->size_id === $sizeId) {
				if ($qty->qty < $request->input("qty")) {
					return redirect()->back()->with("error", "Quantity not available.");
				}
			}
		}

		if (!$sizeId) {
			return back()->withInput()->withErrors(["size-warning" => "Please specify a size."]);
		}

		$duplicates = Cart::search(function ($cartItem, $rowId) use ($id, $sizeId) {
			return $cartItem->id === $id && $cartItem->options->size === $sizeId;
		});
		if ($duplicates->isNotEmpty()) {
			return redirect()->route("cart.index")->with("warning", "Item is already in your cart");
		}

		$price = $product->price;
		Cart::add($id, $product->name, intval($request->input("qty")), $price, ["size" => $sizeId])
			->associate("App\Product");

		if (Auth::check()) {
			if (!empty(Auth::user()->shoppingcart)) {
				Auth::user()->shoppingcart()->delete();
			}
			Cart::store(Auth::user()->id);
		}

		return redirect()->route("cart.index")->with("success", "Item has been added to your cart");
	}


	public function update(Request $request)
	{
		$cartItem = Cart::get($request->input("rowId"));
		foreach ($cartItem->model->quantities as $qty) {
			if ($qty->size_id === intval($cartItem->options->size)) {
				if ($qty->qty < $request->input("qty")) {
					if ($qty->qty < 1) {
						Cart::remove($request->input("rowId"));
						return response()->json([
							"success" => false,
							"message" => "This product is sold out",
							"maxQty" => $qty->qty
						]);
					}

					$cart = Cart::update($request->input("rowId"), $qty->qty);
					return response()->json([
						"delete" => $cart === NULL ? true : false,
						"success" => false,
						"message" => "Maximum quantity is $qty->qty",
						"productPrice" => $cart->model->presentPriceWithQtyWithTax($cart->qty),
						"maxQty" => $qty->qty,
						"remaining" => (Cart::count() > 0) ? true : false,
						"subtotal" => Cart::subtotal(),
						"tax" => Cart::tax(),
						"total" => Cart::total(),
						"cart_count" => Cart::content()->count()
					]);
				}
			}
		}

		$cart = Cart::update($request->input("rowId"), intval($request->input("qty")));

		if ($cart === NULL) {
			return response()->json([
				"delete" => true,
				"message" => "The product has been removed from the cart",
				"remaining" => (Cart::count() > 0) ? true : false,
				"subtotal" => Cart::subtotal(),
				"tax" => Cart::tax(),
				"total" => Cart::total(),
				"cart_count" => Cart::content()->count()
			]);
		}

		return response()->json([
			"success" => true,
			"qty" => $cart->qty,
			"productPrice" => $cart->model->presentPriceWithQtyWithTax($cart->qty),
			"remaining" => (Cart::count() > 0) ? true : false,
			"subtotal" => Cart::subtotal(),
			"tax" => Cart::tax(),
			"total" => Cart::total(),
			"cart_count" => Cart::content()->count()
		]);
	}


	public function updateSize(Request $request)
	{
		$cartIt = Cart::get($request->input("rowId"));
		$sizeId = intval($request->input("sizeId"));
		$requestQty = intval($request->input("qty"));
		$id = $cartIt->id;

		$duplicates = Cart::search(function ($cartItem, $rowId) use ($id, $sizeId) {
			return $cartItem->id === $id && $cartItem->options->size === $sizeId;
		});

		if ($duplicates->isNotEmpty()) {
			return response()->json([
				"success" => false,
				"message" => "This product is already in your cart"
			]);
		}

		foreach ($cartIt->model->quantities as $qty) {
			if ($qty->size_id === $sizeId && $qty->qty > 0) {
				if ($requestQty > $qty->qty) {
					$cartItem = Cart::update($request->input("rowId"), [
						"qty" => $qty->qty,
						"options" => ["size" => $sizeId]
					]);
				} else {
					$cartItem = Cart::update($request->input("rowId"), [
						"options" => ["size" => $sizeId]
					]);
				}

				return response()->json([
					"success" => true,
					"name" => $qty->size->name,
					"cartItem" => $cartItem,
					"qty" => $cartItem->qty,
					"productPrice" => $cartIt->model->presentPriceWithQtyWithTax($cartIt->qty),
					"subtotal" => Cart::subtotal(),
					"tax" => Cart::tax(),
					"total" => Cart::total(),
					"cart_count" => Cart::content()->count()
				]);
			}
		}

		return response()->json([
			"success" => false,
			"message" => "Product not available"
		]);
	}


	public function empty()
	{
		Cart::destroy();

		return redirect()->back()->with("success", "Item(s) have been removed");
	}

	public function destroy($id)
	{
		Cart::remove($id);

		return back()->with("success", "Item(s) have been removed");
	}

}
