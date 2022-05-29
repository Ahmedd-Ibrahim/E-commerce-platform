<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('varition_order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vairation_id');
            $table->unsignedBigInteger('order_id');
            $table->timestamps();

            $table->foreign('vairation_id')->on('variations')->references('id');
            $table->foreign('order_id')->on('orders')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('varition_order');
    }
};
