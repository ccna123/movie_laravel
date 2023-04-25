<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_seats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("movie_id")->unsigned();
            $table->bigInteger("seat_id")->unsigned();
            $table->string("cus_name");
            $table->string("cus_email");
            
            $table->foreign("movie_id")
                ->references("id")
                ->on("movies")
                ->onDelete("cascade");
            
            $table->foreign("seat_id")
                ->references("id")
                ->on("seats")
                ->onDelete("cascade");
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
        Schema::dropIfExists('movie_seats');
    }
};
