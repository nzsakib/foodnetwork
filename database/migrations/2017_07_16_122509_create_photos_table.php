<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('place_id');
            $table->integer('restaurant_id')->nullabel();
            $table->string('filename');
            $table->integer('review_id')->unsigned()->nullable();
            $table->timestamps();

            
            $table->foreign('review_id')
                    ->references('id')
                    ->on('reviews')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints(); 
        Schema::dropIfExists('Photos');
        Schema::enableForeignKeyConstraints();
    }
}
