<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEpisodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('episodes', function (Blueprint $table){
            $table->increments('id');
            $table->integer('seller_id')->unsigned()->default('0');
            $table->integer('series_id')->unsigned()->default('0');
            $table->integer('cost')->unsigned()->default('0');
            $table->longText('sipnopsis')->nullable()->default(NULL);
            $table->string('episode_file')->nullable()->default(NULL);
            $table->enum('status',['Aprobado','En Proceso','Denegado'])->default('En Proceso');

            $table->timestamps();

            $table->foreign('seller_id')->references('id')->on('seller');
            $table->foreign('series_id')->references('id')->on('series');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
