<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->foreignId('method_id');
            $table->foreignId('user_id');
            $table->decimal('amount',28,8)->default(0.00000000);
            $table->string('currency',11);
            $table->decimal('rate',28,8)->default(0.00000000);
            $table->decimal('charge',28,8)->default(0.00000000);
            $table->string('trx');
            $table->decimal('final_amount',28,8)->default(0.00000000);
            $table->decimal('after_charge',28,8)->default(0.00000000);
            $table->text('information')->nullable();
            $table->tinyInteger('status')->default(0)->comment("1=>success, 2=>pending, 3=>cancel,");
            $table->text('feedback')->nullable();
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
        Schema::dropIfExists('deposits');
    }
}
