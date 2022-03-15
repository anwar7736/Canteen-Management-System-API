<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_profile', function (Blueprint $table) {
            $table->id();
            $table->string('shop_logo')->nullable();
            $table->string('shop_name');
            $table->string('shop_address');
            $table->string('shop_owner');
            $table->string('username');
            $table->string('owner_phone');
            $table->string('owner_email');
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
        Schema::dropIfExists('admin_profile');
    }
}
