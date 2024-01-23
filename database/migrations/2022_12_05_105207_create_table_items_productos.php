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
        Schema::create('items_productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('productos_id');
            $table->unsignedBigInteger('items_id');
            $table->text('value');
            $table->foreign('productos_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('items_id')->references('id')->on('items')->onDelete('cascade');

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
        Schema::dropIfExists('items_productos');
    }
};
