<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rois', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('investment_id');
            $table->string('amount');
            $table->tinyInteger('status');
            $table->timestamp('	roi_date');
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
        Schema::dropIfExists('rois');
    }
}
