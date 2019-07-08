<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoldAndHotToProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("products", function($table){
            $table->tinyInteger("sold_out")->default(0);
            $table->tinyInteger("hot")->default(0);
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
            $table->dropColumn("sold_out");
            $table->dropColumn("hot");
        });
    }
}
