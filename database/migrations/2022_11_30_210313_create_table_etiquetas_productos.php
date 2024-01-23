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
        Schema::create('etiquetas_productos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('productos_id');
            $table->unsignedBigInteger('etiquetas_id');
            
            $table->foreign('productos_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('etiquetas_id')->references('id')->on('etiquetas')->onDelete('cascade');

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
        Schema::dropIfExists('etiquetas_productos');
    }
};
