<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('option_id')->nullable();
            $table->foreign('option_id')->references('id')->on('options')->nullOnDelete();
            $table->string('sub_option_name')->nullable();
            $table->string('sub_group_id')->nullable();
            $table->string('sub_option_type')->nullable();
            $table->string('sub_option_min_width')->nullable();
            $table->string('sub_option_min_height')->nullable();
            $table->enum('sub_option_price_type', [1,2])->nullable();
            $table->double('sub_option_price', 5, 2)->nullable();
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
        Schema::dropIfExists('sub_options');
    }
}
