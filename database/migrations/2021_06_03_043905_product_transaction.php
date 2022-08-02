<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_transaction', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('transaction_id');
            $table->integer('quantity');
            $table->decimal('subtotal', 8, 2);
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('transaction_id')->references('id')->on('transactions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_transaction', function (Blueprint $table) {
            $table->dropForeign('product_transaction_product_id_foreign');
            $table->dropForeign('product_transaction_transaction_id_foreign');
        });
        Schema::dropIfExists('product_transaction');
    }
}
