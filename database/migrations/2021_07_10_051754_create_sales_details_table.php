<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sales_id')->unsigned();
            $table->bigInteger('item_id')->unsigned();
            $table->integer('qty');
            $table->integer('price');
            $table->timestamps();
            $table->unique(['sales_id', 'item_id']);
            $table->foreign('sales_id')->references('id')->on('sales')->onUpdate('cascade');
            $table->foreign('item_id')->references('id')->on('item')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_detail');
    }
}
