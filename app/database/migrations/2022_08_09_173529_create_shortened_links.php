<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShortenedLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short_links', function (Blueprint $table) {
            $table->id();

            $table->string('code', 8)->nullable(false);
            $table->string('link', 255)->nullable(false);
            $table->bigInteger('limit')->nullable(false)->default(0);
            $table->dateTime('expired_date')->nullable(false);

            $table->bigInteger('hits')->nullable(false)->default(0);


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
        Schema::dropIfExists('short_links');
    }
}
