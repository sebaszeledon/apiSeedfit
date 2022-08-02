<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductStorage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_storage', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('storage_id');
            $table->integer('quantity');
            $table->integer('limit');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('storage_id')->references('id')->on('storages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_storage', function (Blueprint $table) {
            $table->dropForeign('product_storage_product_id_foreign');
            $table->dropForeign('product_storage_storage_id_foreign');
        });
        Schema::dropIfExists('product_storage');
    }
}
