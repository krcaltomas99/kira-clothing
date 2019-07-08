<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToTables extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("products", function (Blueprint $table) {
			$table->integer("section_id")->unsigned()->index()->change();
			$table->foreign("section_id")->references("id")->on("sections")->onDelete("cascade");
			$table->integer("user_id")->unsigned()->index()->change();
			$table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
			$table->integer("collection_id")->unsigned()->index()->change();
			$table->foreign("collection_id")->references("id")->on("collections")->onDelete("cascade");
			$table->integer("group_id")->unsigned()->index()->change();
			$table->foreign("group_id")->references("id")->on("groups")->onDelete("cascade");
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
			$table->dropForeign(["section_id"]);
			$table->dropIndex(["section_id"]);
			$table->dropForeign(["user_id"]);
			$table->dropIndex(["user_id"]);
			$table->dropForeign(["collection_id"]);
			$table->dropIndex(["collection_id"]);
			$table->dropForeign(["group_id"]);
			$table->dropIndex(["group_id"]);
		});
	}
}
