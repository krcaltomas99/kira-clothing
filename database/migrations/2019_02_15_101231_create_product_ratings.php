<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductRatings extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("product_ratings", function (Blueprint $table) {
			$table->integer("product_id")->unsigned()->index();
			$table->foreign("product_id")->references("id")->on("products")->onDelete("cascade");
			$table->integer("user_id")->unsigned()->index();
			$table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
			$table->smallInteger("rating");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists("product_ratings");
	}
}
