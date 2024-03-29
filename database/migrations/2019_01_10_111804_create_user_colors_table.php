<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserColorsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_colors', function (Blueprint $table) {
			$table->increments('id');
			$table->integer("user_id")->unsigned()->index();
			$table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
			$table->string("value");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('user_colors');
	}
}
