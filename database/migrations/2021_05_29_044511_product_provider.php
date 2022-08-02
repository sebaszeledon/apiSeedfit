<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductProvider extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_provider', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('provider_id');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('provider_id')->references('id')->on('providers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_provider', function (Blueprint $table) {
            $table->dropForeign('product_provider_product_id_foreign');
            $table->dropForeign('product_provider_provider_id_foreign');
        });
        Schema::dropIfExists('product_provider');
    }
}
