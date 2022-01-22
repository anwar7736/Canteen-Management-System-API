<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('token_no');
            $table->string('email');
            $table->string('phone');
            $table->float('amount', 8, 2);
            $table->string('address')->nullable();
            $table->string('transaction_id');
            $table->string('status');
            $table->string('currency');
            $table->string('payment_date');
            $table->string('payment_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
