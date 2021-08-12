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
            $table->text('description')->nullable();
            $table->enum('refrel_system',['on','off'])->default('off');
            $table->integer('refrel_levels')->default(1);
            $table->enum('reward_system',['on','off'])->default('on');
            $table->enum('email_verification',['on','off'])->default('off');
            $table->enum('add_remove_funds_from_admin',['on','off'])->default('on');
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
