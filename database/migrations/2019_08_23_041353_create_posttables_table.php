<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePosttablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posttables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('productname')->nullable();
            $table->integer('price')->nullable();
            $table->string('description')->nullable();
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
        Schema::drop('posttables');
    }
}
