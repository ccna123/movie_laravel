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
        Schema::create('profits', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("movie_id")->unsigned();
            $table->mediumInteger("profit");
            $table->timestamps();

            $table->foreign("movie_id")
                  ->references("id")
                  ->on("movies");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profts');
    }
};
