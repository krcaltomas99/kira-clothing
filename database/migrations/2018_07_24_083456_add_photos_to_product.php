<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhotosToProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("products", function($table){
            $table->string("nahled_photo");
        });

        Schema::create('photos_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("product_id");
            $table->string("photo");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("products", function($table){
            $table->dropColumn("nahled_photo");
        });

        Schema::dropIfExists('photos_product');
    }
}
