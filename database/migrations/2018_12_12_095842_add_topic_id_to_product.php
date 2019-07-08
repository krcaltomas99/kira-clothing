<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTopicIdToProduct extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("products", function(Blueprint $table){
			$table->integer("topic_id")->unsigned()->index()->nullable();
			$table->foreign("topic_id")->references("id")->on("topics");
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
			$table->dropForeign(["topic_id"]);
			$table->dropIndex(["topic_id"]);
		});
	}
}
