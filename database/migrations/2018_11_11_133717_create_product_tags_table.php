<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTagsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_tags', function (Blueprint $table) {
			$table->increments('id');
			$table->integer("product_id")->unsigned()->index();
			$table->foreign("product_id")->references("id")->on("products")->onDelete("cascade");
			$table->integer("tag_id")->unsigned()->index();
			$table->foreign("tag_id")->references("id")->on("tags")->onDelete("cascade");
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('product_tags');
	}
}
