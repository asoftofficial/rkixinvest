<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('planId')->nullable();
            $table->string('name');
            $table->string('description');
            $table->string('stripe_id')->nullable();
            $table->double('price');
            $table->tinyInteger('front');
            $table->tinyInteger('status');
            $table->string('partner_name')->nullable();
            $table->string('file_path')->nullable();
            $table->string('text')->nullable();
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
        Schema::dropIfExists('table_plans');
    }
}
