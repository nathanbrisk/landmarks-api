<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsZipCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('us_zip_codes', function (Blueprint $table) {
            $table->increments('id')->nullable(false);
            // this is a value object . . . so the value is the only unique component
            $table->string('zip_code')->unique()->nullable(false);
            $table->string('city')->nullable(false);
            $table->string('state')->nullable(false);
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
        Schema::dropIfExists('us_zip_codes');
    }
}
