<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_rates', function (Blueprint $table) {
            $table->id();
            $table->string('lunch_expiry_time');
            $table->string('dinner_expiry_time');
            $table->integer('lunch_rate');
            $table->text('lunch_rate_bangla');
            $table->integer('dinner_rate');
            $table->text('dinner_rate_bangla');
            $table->integer('total_rate');
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
        Schema::dropIfExists('meal_rates');
    }
}
