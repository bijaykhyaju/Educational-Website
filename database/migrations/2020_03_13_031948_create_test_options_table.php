<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('test_id')->unsigned();
            $table->boolean('right_option')->default(false);
            $table->integer('order')->unsigned()->default('1');
            $table->boolean('publish')->default(true);
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
        Schema::dropIfExists('test_options');
    }
}
