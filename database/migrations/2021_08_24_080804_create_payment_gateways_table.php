<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('currency');
            $table->text('parameters');
            $table->text('image');
            $table->decimal('min_ammount', 18,8)->default(0.00);
            $table->decimal('max_ammount', 18,8)->default(0.00);
            $table->decimal('charge', 18,8)->default(0.00);
            $table->tinyInteger('charge_type')->comment("1 = fixed, 2 = percentage")->default(1);
            $table->tinyInteger('status')->comment("1 = active, 2 = inactive")->default(1);
            $table->text('callback')->nullable();
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
        Schema::dropIfExists('payment_gateways');
    }
}
