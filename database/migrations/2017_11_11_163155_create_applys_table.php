<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    Schema::create('applys_sellers', function (Blueprint $table) 
    {
    
    $table->increments('id');
    $table->integer('promoter_id')->nullable()->default(NULL);
    $table->string('name_c')->nullable()->default(NULL);
    $table->string('token')->nullable()->default(NULL);
    $table->string('contact_s')->nullable()->default(NULL);
    $table->string('phone_s')->nullable()->default(NULL);
    $table->string('email')->nullable()->default(NULL);
    $table->dateTime('expires_at')->nullable()->default(NULL);
    $table->dateTime('assing_at')->nullable()->default(NULL);
    $table->enum('status',['Aprobado','En Proceso','Denegado'])->default('En Proceso');
    $table->timestamps();
    $table->foreign('promoter_id')->references('id')->on('promoter');
    
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
