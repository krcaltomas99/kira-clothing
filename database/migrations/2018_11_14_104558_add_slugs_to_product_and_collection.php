<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugsToProductAndCollection extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("products", function ($table) {
			$table->string("slug");
		});

		Schema::table("collections", function ($table) {
			$table->string("slug");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table("collections", function ($table) {
			$table->dropColumn("slug");
		});

		Schema::table("products", function ($table) {
			$table->dropColumn("slug");
		});
	}
}
