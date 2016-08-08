<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videoables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('video_id')->unsigned()->index();
            $table->integer('videoable_id')->unsigned()->index();
            $table->string('videoable_type')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('videoables');
    }
}
