<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('type_id');
            $table->date('date');
            $table->integer('total_quantity');
            $table->decimal('total_amount', 8, 2);
            $table->text('description')->nullable();
            $table->text('observation')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('type_id')->references('id')->on('types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions', function (Blueprint $table) {
            $table->dropForeign('transactions_user_id_foreign');
            $table->dropForeign('transactions_type_id_foreign');
        });
        Schema::dropIfExists('transactions');
    }
}
