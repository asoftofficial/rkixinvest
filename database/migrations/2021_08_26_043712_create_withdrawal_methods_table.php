<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawal_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->decimal('min_limit',28,8)->default(0.00000000);
            $table->decimal('max_limit',28,8)->default(0.00000000);
            $table->string('delay')->nullable();
            $table->decimal('fixed_charge',28,8)->default(0.00000000);
            $table->decimal('percent_charge',28,8)->nullable();
            $table->string('currency')->nullable();
            $table->text('user_date')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('withdrawal_methods');
    }
}
