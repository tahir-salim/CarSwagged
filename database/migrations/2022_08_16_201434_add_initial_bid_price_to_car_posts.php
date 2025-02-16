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
        Schema::table('car_posts', function (Blueprint $table) {
            $table->integer('initial_bid_price')->after('total_bid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('car_posts', function (Blueprint $table) {
            $table->dropColumn('initial_bid_price');
        });
    }
};
