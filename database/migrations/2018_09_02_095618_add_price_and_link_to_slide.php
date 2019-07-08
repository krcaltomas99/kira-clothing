<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPriceAndLinkToSlide extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('products', function ($table) {
			$table->string('price');
		});
		Schema::table('slides', function ($table) {
			$table->integer('points_to_id')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table("products", function ($table) {
			$table->dropColumn("price");
		});

		Schema::table("slides", function ($table) {
			$table->dropColumn("points_to_id");
		});
	}
}
