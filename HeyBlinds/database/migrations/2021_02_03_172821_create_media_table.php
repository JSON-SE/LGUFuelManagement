<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('name', 1000)->nullable();
            $table->string('alt_text', 1000)->nullable();
            $table->string('caption', 1000)->nullable();
            $table->string('description', 1000)->nullable();
            $table->string('mime', 1000)->nullable();
            $table->string('original_path', 1000);
            $table->string('thumb_path', 1000)->nullable();
            $table->string('original_url', 1000)->nullable();
            $table->string('thumb_url', 1000)->nullable();
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
        Schema::dropIfExists('media');
    }
}
