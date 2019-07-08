<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteTopics extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("products", function(Blueprint $table){
			$table->dropForeign(["topic_id"]);
			$table->dropIndex(["topic_id"]);
			$table->dropColumn("topic_id");
		});
		Schema::dropIfExists("topics");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table("topics", function (Blueprint $table) {
			$table->string("name");
			$table->string("icon")->default("placeholder.jpg");
		});

		Schema::table("products", function(Blueprint $table){
			$table->integer("topic_id")->unsigned()->index()->nullable();
			$table->foreign("topic_id")->references("id")->on("topics");
		});
	}
}
