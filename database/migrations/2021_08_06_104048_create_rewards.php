<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('gold reward');
            $table->integer('amount')->default('200');
            $table->integer('referral')->default('2');
            $table->enum('status',['enabled','disabled'])->default('enabled');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('rewards');
    }
}
