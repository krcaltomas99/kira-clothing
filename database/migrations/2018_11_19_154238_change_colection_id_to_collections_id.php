<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColectionIdToCollectionsId extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("products", function ($table){
			$table->integer("collection_id")->nullable();
			$table->dropColumn("colection_id");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table("products", function ($table){
			$table->dropColumn("collection_id");
			$table->integer("colection_id")->nullable();
		});
	}
}
