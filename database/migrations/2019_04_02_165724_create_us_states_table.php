<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('us_states', function (Blueprint $table) {
            $table->increments('id')->nullable(false);
            $table->string('slug')->nullable(false);
            // this is a value object . . . so the value is the only unique component
            $table->string('title')->unique()->nullable(false);
            $table->string('abbrev')->nullable(false);
            $table->integer('order')->nullable(true);
            $table->boolean('active')->nullable(true);
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
        Schema::dropIfExists('us_states');
    }
}
