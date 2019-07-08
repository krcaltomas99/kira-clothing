<?php

namespace App\Http\Controllers;

use App\Notifications\UserRegisteredByOrder;
use App\Notifications\UserOrderedNotification;
use App\Order;
use App\OrderProduct;
use App\ShippingAddress;
use App\User;

use Illuminate\Http\Request;
use PayPal\Api\PaymentExecution;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class PaymentController extends Controller
{

	public function create()
	{
		$apiContext = new ApiContext(
			new OAuthTokenCredential(
				"AUZmA_7vv75N2J6BPiDNhdt-DVlZ1XVvNa4XTv5KAbbNvq70WvU-XYAvtbrQyRJkwrT5X6fJ_5QUgCpb",
				"EEZtpPeBDG80JrGCXR22S0Kw7HYAQeo7KtnkRhL3OWdPOjDIu2JPahzUy2yChilMeNYnPmrkzbsXfCSR"
			)
		);
		/*
		$apiContext->setConfig(
		array(
		'mode' => 'live',
		'log.LogEnabled' => true,
		'log.FileName' => '../PayPal.log',
		'log.LogLevel' => 'INFO', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
		)
		);
		*/

		$payer = new Payer();
		$payer->setPaymentMethod("paypal");
		$items = [];
		$i = 0;
		foreach (Cart::content() as $cartItem) {
			$items[$i] = new Item();
			$items[$i]->setName($cartItem->name)
				->setCurrency("USD")
				->setQuantity($cartItem->qty)
				->setSku($cartItem->id)
				->setPrice($cartItem->price);
			$i++;
		}

		$itemList = new ItemList();
		$itemList->setItems($items);

		$details = new Details();
		$details->setShipping(0)
			->setTax(Cart::tax())
			->setSubtotal(Cart::subtotal());

		$amount = new Amount();
		$amount->setCurrency("USD")
			->setTotal(Cart::total())
			->setDetails($details);

		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setItemList($itemList)
			->setDescription("Payment for listed products to Kira company. We hope you enjoy your good's. Thank you for supporting us.")
			->setInvoiceNumber(uniqid());

		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl("http://localdev.kira.cz")
			->setCancelUrl("http://localdev.kira.cz");

		$payment = new Payment();
		$payment->setIntent("sale")
			->setPayer($payer)
			->setRedirectUrls($redirectUrls)
			->setTransactions([$transaction]);

		try {
			$payment->create($apiContext);
		} catch (Exception $ex) {
			echo $ex;
			exit(1);
		}

		return $payment;
	}


	public function execute(Request $request)
	{
		$apiContext = new ApiContext(
			new OAuthTokenCredential(
				"AUZmA_7vv75N2J6BPiDNhdt-DVlZ1XVvNa4XTv5KAbbNvq70WvU-XYAvtbrQyRJkwrT5X6fJ_5QUgCpb",
				"EEZtpPeBDG80JrGCXR22S0Kw7HYAQeo7KtnkRhL3OWdPOjDIu2JPahzUy2yChilMeNYnPmrkzbsXfCSR"
			)
		);
		//$apiContext->setConfig(
		//array(
		//'mode' => 'live',
		//'log.LogEnabled' => true,
		//'log.FileName' => '../PayPal.log',
		//'log.LogLevel' => 'INFO', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
		//)
		//);

		$paymentId = $request->paymentID;
		$payment = Payment::get($paymentId, $apiContext);

		$execution = new PaymentExecution();
		$execution->setPayerId($request->payerID);

		try {
			$result = $payment->execute($execution, $apiContext);
		} catch (Exception $ex) {
			echo $ex;
			exit(1);
		}

		return $result;
	}


	public function success(Request $request)
	{
		$data = $request->input("data");
		$shippingAddress = $data["payer"]["payer_info"]["shipping_address"];
		$user_email = $data["payer"]["payer_info"]["email"];
		$recipient_name = $shippingAddress["recipient_name"];


		$transaction = $data["transactions"][0];
		$paypal_id = $data["id"];
		$currency = $transaction["amount"]["currency"];
		$invoice_number = $transaction["invoice_number"];

		$subtotal = Cart::subtotal();
		$total = Cart::total();
		$tax = Cart::tax();

		if (Auth::check()) {
			$user = Auth::user();
		} else {
			$user = User::where("email", $user_email)->first();
		}

		//JESTLI UZIVATEL NEEXISTUJE
		if (!$user) {
			//GENERATE SAFE PASSWORD
			$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
			$pass = array(); //remember to declare $pass as an array
			$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
			for ($i = 0; $i < 8; $i++) {
				$n = rand(0, $alphaLength);
				$pass[] = $alphabet[$n];
			}
			$password = implode($pass);

			$user = new User;
			$user->name = $recipient_name;
			$user->password = Hash::make($password);
			$user->email = $user_email;
			$user->role = "customer";
			$user->save();
			$user->notify(new UserRegisteredByOrder($user, $password));
		}

		//JESTLI UZ MA SHIPPING ADDRESS
		if ($user->shipping_address) {
			$shipping_id = $user->shipping_address->id;
		} else {
			$state = $shippingAddress["state"];
			$city = $shippingAddress["city"];
			$address = $shippingAddress["line1"];
			$country_code = $shippingAddress["country_code"];
			$postal_code = $shippingAddress["postal_code"];

			$shipping_address = new ShippingAddress;
			$shipping_address->user_id = $user->id;
			$shipping_address->city = $city;
			$shipping_address->address = $address;
			$shipping_address->country_code = $country_code;
			$shipping_address->postal_code = $postal_code;
			$shipping_address->state = $state;
			$shipping_address->save();
			$shipping_id = $shipping_address->id;
		}

		$order = new Order;
		$order->paypal_id = $paypal_id;
		$order->user_id = $user->id;
		$order->currency = $currency;
		$order->invoice_number = $invoice_number;
		$order->shipping_id = $shipping_id;
		$order->subtotal = $subtotal;
		$order->tax = $tax;
		$order->total = $total;
		$order->recipient_name = $recipient_name;
		$order->finished = 0;
		$order->save();

		foreach (Cart::content() as $item) {
			$order_product = new OrderProduct;
			$order_product->order_id = $order->id;
			$order_product->product_id = $item->id;
			$order_product->qty = $item->qty;
			$order_product->size = $item->options->size;
			$order_product->price = $item->price;
			$order_product->save();
			$item->model->addSold();
		}

		//SUCCESS | NOTIFY THE USER
		$user->notify(new UserOrderedNotification($order));
		session(["purchased" => true]);
		Cart::destroy();

		return response()->json([
			"success" => true,
			"orderId" => $order->id
		]);
	}


	public function thankyou()
	{
		$orderId = Input::get("id");
		$order = Order::findOrFail($orderId);
		$purchased = session("purchased", false);

		if ($purchased) {
			session(["purchased" => false]);
			return view("checkout.thankyou")->with("order", $order);
		}

		return redirect()->route("cart.index")->with("warning", "You haven't purchased anything.");
	}

}
