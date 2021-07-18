<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTableCars2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->string('starting_point_a')->nullable();
            $table->string('starting_point_b')->nullable();
            $table->string('last_point_a')->nullable();
            $table->string('last_point_b')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('starting_point_a');
            $table->dropColumn('starting_point_b');
            $table->dropColumn('last_point_a');
            $table->dropColumn('last_point_b');
        });
    }
}
