<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->bigInteger('promo_id')->nullable()->unsigned();
            $table->integer('discount_percent');
            $table->foreign('promo_id')->references('id')->on('promo')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropForeign(['promo_id']);
            $table->dropColumn('discount_percent');
            $table->dropColumn('promo_id');
        });
    }
}
