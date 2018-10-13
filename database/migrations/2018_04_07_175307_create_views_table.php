<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('views', function (Blueprint $table) {
            $table->increments('id');
            $table->string('link_shortLink')->foreign('link')->references('shortLink')->on('links')->onDelete('cascade')->onUpdate('cascade');
            $table->string('referer', 64);
            $table->string('ip', 15);
            $table->string('isp');
            $table->string('osName', 13);
            $table->string('osVersion', 20);
            $table->string('browserName', 30);
            $table->integer('browserVersion')->length(3)->unsigned();
            $table->string('country', 50);
            $table->string('city', 30);
            $table->string('device', 8);
            $table->index('link_shortLink');
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
        Schema::dropIfExists('views');
    }
}
