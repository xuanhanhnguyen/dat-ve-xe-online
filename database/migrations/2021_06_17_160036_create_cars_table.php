<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('brand_id');
            $table->string('image')->nullable();
            $table->string('type_car');
            $table->string('number_seats');
            $table->unsignedInteger('station_a');
            $table->string('time_start_b');
            $table->unsignedInteger('station_b');
            $table->string('time_start_a');
            $table->string('total_time');
            $table->integer('price');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('station_a')->references('id')->on('places')->onDelete('cascade');
            $table->foreign('station_b')->references('id')->on('places')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
