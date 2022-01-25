<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_statements', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->string('month');
            $table->integer('token_no');
            $table->integer('total_lunch');
            $table->integer('lunch_cost');
            $table->integer('total_dinner');
            $table->integer('dinner_cost');
            $table->integer('total_meal');
            $table->integer('total_cost');
            $table->integer('total_payment');
            $table->integer('give_take');
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
        Schema::dropIfExists('monthly_statements');
    }
}
