<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('team_id')->unique();
            $table->integer('rp')->default(0);
            $table->integer('goles')->default(0);
            $table->integer('ganados')->default(0);
            $table->integer('perdidos')->default(0);
            $table->integer('faltas')->default(0);
            $table->integer('tr')->default(0);
            $table->integer('ta')->default(0);

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
        Schema::dropIfExists('statistics');
    }
}
