<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreForeignKeys extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("product_colors", function (Blueprint $table) {
			$table->integer("product_id")->unsigned()->index()->change();
			$table->foreign("product_id")->references("id")->on("products");
		});

		Schema::table("product_images", function (Blueprint $table) {
			$table->integer("product_id")->unsigned()->index()->change();
			$table->foreign("product_id")->references("id")->on("products");
		});

		Schema::table("product_sizes", function (Blueprint $table) {
			$table->integer("product_id")->unsigned()->index()->change();
			$table->foreign("product_id")->references("id")->on("products");
			$table->integer("size_id")->unsigned()->index()->change();
			$table->foreign("size_id")->references("id")->on("sizes");
		});

		Schema::table("social_accounts", function (Blueprint $table) {
			$table->integer("user_id")->unsigned()->index()->change();
			$table->foreign("user_id")->references("id")->on("users");
		});

		Schema::dropIfExists("product_user");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table("product_colors", function (Blueprint $table) {
			$table->dropForeign(["product_id"]);
			$table->dropIndex(["product_id"]);
		});

		Schema::table("product_images", function (Blueprint $table) {
			$table->dropForeign(["product_id"]);
			$table->dropIndex(["product_id"]);
		});

		Schema::table("product_sizes", function (Blueprint $table) {
			$table->dropForeign(["product_id"]);
			$table->dropIndex(["product_id"]);
			$table->dropForeign(["size_id"]);
			$table->dropIndex(["size_id"]);
		});

		Schema::table("social_accounts", function (Blueprint $table) {
			$table->dropForeign(["user_id"]);
			$table->dropIndex(["user_id"]);
		});
	}
}
