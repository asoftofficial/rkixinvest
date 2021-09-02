<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_id')->nullable();
            $table->string('username')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('image')->nullable();
            $table->double('balance')->default(0);
            $table->tinyInteger('gender')->comment("1 = male, 2 = Female, 3 = Non Binary, 4 = Perefer not to say")->nullable();
            $table->date('dob')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_verification_code')->nullable();
            $table->tinyInteger('email_verified')->comment("1 = verified, 0 = unverified")->default(0);
            $table->string('password')->nullable();
            $table->tinyInteger('type')->default(1)->comment('1 = user,3 = admin');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->integer('country_id')->nullable();
            $table->string('post_code')->nullable();
            $table->tinyInteger('blocked')->nullable();
            $table->string('role')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
