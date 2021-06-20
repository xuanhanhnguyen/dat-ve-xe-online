<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('car_id');
            $table->string('name');
            $table->string('phone');
            $table->boolean('a_to_b')->default(true);
            $table->unsignedInteger('stopover_station_a');
            $table->unsignedInteger('stopover_station_b');
            $table->integer('price');
            $table->tinyInteger('quantity');
            $table->bigInteger('amount_total');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
