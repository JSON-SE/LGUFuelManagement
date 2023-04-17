<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_color_name')->nullable();
            $table->string('vendor_color_id')->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->boolean('disclaimer')->default(0);
            $table->integer('quantity')->default(0)->nullable();
            $table->boolean('out_of_stock')->default(0)->nullable();
            $table->string('color_id')->unique();

            $table->unsignedBigInteger('color_group_id')->nullable();
            $table->foreign('color_group_id')->references('id')->on('color_groups')->nullOnDelete();

            $table->boolean('is_enable')->nullable();
            $table->integer('remaining_quantity')->default(0);
            $table->unsignedBigInteger('color_image_id')->nullable();
            $table->foreign('color_image_id')->references('id')->on('media')->nullOnDelete();

            $table->unsignedBigInteger('feature_image_id')->nullable();
            $table->foreign('feature_image_id')->references('id')->on('media')->nullOnDelete();

            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('colors');
    }
}
