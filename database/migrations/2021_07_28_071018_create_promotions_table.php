<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('desc');
            $table->string('logo');
            $table->integer('plan_id');
            $table->enum('discount_type',['per','flat'])->default('per');
            $table->string('discount');
            $table->string('code');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('limit_per_user')->default('-1')->nullable();
            $table->string('limit_per_coupon')->default('-1')->nullable();
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
        Schema::dropIfExists('promotions');
    }
}
