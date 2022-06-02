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
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('shipping_method_id')->index()->after('user_id');
            $table->unsignedBigInteger('address_id')->index()->after('shipping_method_id');
            $table->foreign('shipping_method_id')->on('shipping_methods')->references('id');
            $table->foreign('address_id')->on('addresses')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->dropColumn('shipping_method_id');
            $table->dropColumn('address_id');
        });
    }
};
