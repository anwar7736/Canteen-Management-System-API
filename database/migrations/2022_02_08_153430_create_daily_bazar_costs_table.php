<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyBazarCostsTable extends Migration
{

    public function up()
    {
        Schema::create('daily_bazar_costs', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->string('month');
            $table->string('date');            
            $table->string('name');
            $table->double('amount', 8,2);

        });
    }

    public function down()
    {
        Schema::dropIfExists('daily_bazar_costs');
    }
}
