<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNahledPhotoMinToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('products', function ($table) {
		    $table->string('nahled_photo_min')->after("nahled_photo");
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table("products", function ($table) {
		    $table->dropColumn("nahled_photo_min");
	    });
    }
}
