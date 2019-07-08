<?php

namespace App\Http\Controllers;

use App\OrderProduct;
use App\Product;
use App\User;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Input;

class AdminOrdersController extends Controller
{

	public function __construct()
	{
		$this->middleware("employee")->only(["index"]);
		$this->middleware("admin")->only(["edit", "update", "finish"]);
		$this->middleware("superadmin")->only(["destroy", "updateProducts"]);
	}


	public function index(Request $request)
	{
		$allowedSorts = ["id", "recipient_name", "subtotal", "tax", "total", "created_at", "updated_at", "finished"];
		$allowedOrder = ["asc", "desc", "ASC", "DESC"];
		$sort = Input::get("sort");
		$order = Input::get("order");

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
		$orders = Order::orderBy($sort, $order)->paginate(12);

		return view("admin.orders.index")->with("orders", $orders);
	}


	public function edit(int $id)
	{
		$order = Order::findOrFail($id);
		$products = Product::all();
		$users = User::all();

		return view("admin.orders.edit", compact("order", "products", "users"));
	}


	public function finish(int $id)
	{
		$order = Order::findOrFail($id);
		$order->finish();

		return redirect()->route("admin.orders.index")->with("success", "Order status has been changed");
	}


	public function update(Request $request, $id)
	{
		$order = Order::findOrFail($id);

		$order->user_id = $request->input("user");
		$order->recipient_name = $request->input("recipient");
		$order->save();

		return redirect(route("admin.orders.edit", ["id" => $order->id, "#tab-information"]))->with("success", "Order has been changed");
	}

	public function updateProducts(Request $request, $id)
	{
		$order = Order::findOrFail($id);
		$order->products()->delete();
		$subtotal = 0;

		foreach ($request->input("products") as $productId => $item) {
			$qty = $item["qty"];
			if ($qty == 0) continue;
			$product = Product::find($productId);
			$subtotal += $product->price * $qty;

			$orderProduct = new OrderProduct;
			$orderProduct->order_id = $order->id;
			$orderProduct->product_id = $productId;
			$orderProduct->qty = $qty;
			$orderProduct->size = $item["size"];
			$orderProduct->price = $product->price;
			$orderProduct->save();
		}

		if ($request->has("product")) {
			$product = Product::find($request->input("product"));
			$subtotal += $product->price;

			$orderProduct = new OrderProduct;
			$orderProduct->order_id = $order->id;
			$orderProduct->product_id = $request->input("product");
			$orderProduct->qty = 1;
			$orderProduct->size = 1;
			$orderProduct->price = $product->price;
			$orderProduct->save();
		}

		$tax = $subtotal * 0.21;
		$total = $subtotal + $tax;

		$order->subtotal = number_format($subtotal, 2, ".", "");
		$order->tax = number_format($tax, 2, ".", "");
		$order->total = number_format($total, 2, ".", "");
		$order->save();

		return redirect(route("admin.orders.edit", ["id" => $order->id, "#tab-products"]))->with("success", "Products have been changed");
	}

}
