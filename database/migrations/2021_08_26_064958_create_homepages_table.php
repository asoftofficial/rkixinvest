<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomepagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homepages', function (Blueprint $table) {
            $table->id();
            $table->string('section_title')->default('About us');
            $table->string('section_heading')->default('Earn more profit');
            $table->string('section_image')->nullable();
            $table->text('section_description')->nullable();
            $table->string('button_text')->default('more info');
            $table->string('link')->default('http://rkixinvest.test/#');
            $table->string('step_title')->default('how to invest');
            $table->text('step_content')->nullable();
            $table->string('step1')->default('Deposit Amount');
            $table->string('step2')->default('Buy package');
            $table->string('step3')->default('Earn Profit');
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
        Schema::dropIfExists('homepages');
    }
}
