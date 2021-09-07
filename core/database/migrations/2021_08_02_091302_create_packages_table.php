<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->integer('min_invest')->nullable();
            $table->integer('max_invest')->nullable();
            $table->integer('duration')->default(1);
            $table->enum('duration_type',['day','week','month','year']);
            $table->double('roi')->nullable();
            $table->enum('roi_type', ['daily','weekly', 'monthly', 'yearly'])->default('daily');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('packages');
    }
}
