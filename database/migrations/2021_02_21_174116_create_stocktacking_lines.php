<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocktackingLines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocktacking_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('transaction_id');
            $table->integer('variation_id');
            $table->integer('created_by');
            $table->string('current_stock');
            $table->string('real_qty_available');
           
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
        Schema::dropIfExists('stocktacking_lines');
    }
}
