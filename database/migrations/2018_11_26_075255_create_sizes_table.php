<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSizesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sizes', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
		});

		DB::table("sizes")->insert([
			["name"=>"extra small"],
			["name"=>"small"],
			["name"=>"medium"],
			["name"=>"large"],
			["name"=>"extra large"],
		]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('sizes');
	}
}
