<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepublicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('republics', function (Blueprint $table) {
            $table->id();
            $table->integer('locator_id')->unsigned()->nullable();
            $table->string('locator_name');
            $table->string('street');
            $table->string('number');
            $table->string('complement');
            $table->string('neighborhood');
            $table->string('city');
            $table->string('state');
            $table->longText('description');
            $table->float('price');
            $table->string('available_vacancies');
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
        Schema::dropIfExists('republics');
    }
}
