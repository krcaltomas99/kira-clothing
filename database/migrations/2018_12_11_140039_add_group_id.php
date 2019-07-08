<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGroupId extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("groups", function (Blueprint $table) {
			$table->increments("id");
		});

		Schema::table("products", function (Blueprint $table) {
			$table->integer("group_id")->nullable();
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
			$table->dropColumn("group_id");
		});

		Schema::dropIfExists("groups");
	}
}
