<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoverImgToCollections extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('collections', function ($table) {
			$table->increments('id');
			$table->string("name");
			$table->string("cover_img");
		});
		Schema::dropIfExists('colections');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::create('colections', function (Blueprint $table) {
			$table->increments('id');
			$table->string("name");
		});
		Schema::dropIfExists('collections');
	}
}
