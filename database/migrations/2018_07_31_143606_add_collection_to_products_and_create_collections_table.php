<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCollectionToProductsAndCreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("products", function($table){
            $table->integer("colection_id")->nullable();
        });

        Schema::create('colections', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
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
            $table->dropColumn("colection_id");
        });

        Schema::dropIfExists('colections');
    }
}
