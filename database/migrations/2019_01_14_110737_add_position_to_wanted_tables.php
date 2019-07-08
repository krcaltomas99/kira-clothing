<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPositionToWantedTables extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("product_images", function (Blueprint $table) {
			$table->integer("position")->default(0);
		});

		Schema::table("shipping_address", function (Blueprint $table) {
			$table->string("phone")->nullable()->change();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table("product_images", function (Blueprint $table) {
			$table->dropColumn("position");
		});
	}
}
