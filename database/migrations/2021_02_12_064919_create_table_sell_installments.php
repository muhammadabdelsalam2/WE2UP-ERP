<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSellInstallments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_sell_installments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('transaction_id')->unsigned();
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
            $table->decimal('amount','22','4');
            $table->date('due_at');
            $table->date('paid_at')->nullable();
            $table->string('status');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_sell_installments');
    }
}
