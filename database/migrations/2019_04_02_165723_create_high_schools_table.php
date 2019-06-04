<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHighSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('high_schools', function (Blueprint $table) {
            $table->increments('id')->nullable(false);
            $table->string('slug')->nullable(false);
            $table->string('title')->nullable(false);
            $table->string('city')->nullable(false);
            $table->string('state')->nullable(false);
            $table->integer('order')->nullable(true);
            $table->boolean('active')->nullable(true);
            $table->timestamps();
            // this is a value object . . . so the title/city/state is the only unique component
            $table->unique(['title', 'city', 'state']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('high_schools');
    }
}
