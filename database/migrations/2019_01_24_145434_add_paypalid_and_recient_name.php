<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaypalidAndRecientName extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("orders", function (Blueprint $table) {
			$table->string("paypal_id")->after("id")->nullable();
			$table->string("recipient_name");
			$table->dropColumn("method");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table("orders", function (Blueprint $table) {
			$table->dropColumn("paypal_id");
			$table->dropColumn("recipient_name");
			$table->string("method");
		});
	}
}
