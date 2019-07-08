<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQtyAndSizeToOrderProducts extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("order_products", function (Blueprint $table) {
			$table->integer("qty");
			$table->integer("size");
			$table->string("price");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table("order_products", function (Blueprint $table) {
			$table->dropColumn("qty");
			$table->dropColumn("size");
			$table->dropColumn("price");
		});
	}
}
