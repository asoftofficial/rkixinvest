<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->bigInteger('collection_id');
            $table->date('publish_date');
            $table->date('release_date');
            $table->integer('magazine_id');
            $table->string('image_path');
            $table->string('file_path');
            $table->string('page_title')->nullable();
            $table->string('desc')->nullable();
            $table->text('keywords')->nullable();
            $table->enum('status',['live','offline'])->default('offline');
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
        Schema::dropIfExists('issues');
    }
}
