<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUltraMinToProducts extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("products", function (Blueprint $table) {
			$table->string("nahled_photo_ultra_min")->after("nahled_photo_min")->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table("products", function (Blueprint $table) {
			$table->dropColumn("nahled_photo_ultra_min");
		});
	}
}
