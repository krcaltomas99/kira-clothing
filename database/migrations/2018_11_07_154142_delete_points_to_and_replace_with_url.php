
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeletePointsToAndReplaceWithUrl extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('slides', function ($table) {
			$table->dropColumn("points_to");
			$table->dropColumn("points_to_id");
			$table->string("url_dest")->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('slides', function ($table) {
			$table->string("points_to");
			$table->integer("points_to_id");
			$table->string("url_dest")->nullable();
		});
	}
}
