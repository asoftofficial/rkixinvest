<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_links', function (Blueprint $table) {
            $table->id();
            $table->string('facebook')->default('https://www.facebook.com/Rkixtech');
            $table->string('twitter')->default('https://twitter.com');
            $table->string('pintrest')->default('https://www.pinterest.com/');
            $table->string('linkedin')->default('https://www.linkedin.com/company/rkixtech/mycompany/');
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
        Schema::dropIfExists('social_links');
    }
}
