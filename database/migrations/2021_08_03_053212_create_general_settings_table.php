<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('web_title')->default('RkixInvest');
            $table->string('fav_icon')->nullable();
            $table->string('logo')->nullable();
            $table->string('email')->default('info@rkixinvest.com');
            $table->string('phone')->default('0900-78-01');
            $table->string('address')->default('joharTown,F block,Lahore');
            $table->text('description')->nullable();
            $table->enum('refrel_system',['on','off'])->default('off');
            $table->integer('referral_levels')->default(1);
            $table->enum('reward_system',['on','off'])->default('on');
            $table->enum('email_verification',['on','off'])->default('off');
            $table->enum('add_fund',['on','off'])->default('on');
            $table->enum('remove_fund',['on','off'])->default('on');
            $table->enum('add_remove_funds_from_admin',['on','off'])->default('on');
             $table->enum('kyc',['on','off'])->default('on');
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
        Schema::dropIfExists('general_settings');
    }
}
