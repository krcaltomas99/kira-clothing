<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("shipping_address", function (Blueprint $table) {
			$table->increments("id");
			$table->integer("user_id")->unsigned()->index();
			$table->foreign("user_id")->references("id")->on("users");
			$table->string("city");
			$table->string("address");
			$table->string("country_code")->nullable();
			$table->string("state")->nullable();
			$table->string("postal_code");
		});

		Schema::create('orders', function (Blueprint $table) {
			$table->increments('id');
			$table->integer("user_id")->unsigned()->index();
			$table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
			$table->string("method");
			$table->string("currency")->default("USD");
			$table->string("invoice_number")->nullable();
			$table->integer("shipping_id")->unsigned()->index();
			$table->foreign("shipping_id")->references("id")->on("shipping_address");
			$table->string("shipping")->default("0");
			$table->string("subtotal");
			$table->string("tax");
			$table->string("total");
			$table->timestamps();
		});

		Schema::create("order_products", function (Blueprint $table) {
			$table->increments("id");
			$table->integer("order_id")->unsigned()->index();
			$table->foreign("order_id")->references("id")->on("orders")->onDelete("cascade");
			$table->integer("product_id")->unsigned()->index();
			$table->foreign("product_id")->references("id")->on("products")->onDelete("cascade");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('order_products');
		Schema::dropIfExists('orders');
		Schema::dropIfExists('shipping_address');
	}
}
