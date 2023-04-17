<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('option_type', 20)->nullable();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('media_id')->nullable();
            $table->foreign('media_id')->references('id')->on('media')->nullOnDelete();
            $table->unsignedBigInteger('tooltip_media_id')->nullable();
            $table->foreign('tooltip_media_id')->references('id')->on('media')->nullOnDelete();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->foreign('group_id')->references('id')->on('option_groups')->nullOnDelete();
            $table->boolean('is_free')->default(true)->nullable();
            $table->boolean('is_always_included')->default(false)->nullable();
            $table->boolean('is_active')->default(true)->nullable();
            $table->string('content')->nullable();
            $table->text('color')->nullable();
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
        Schema::dropIfExists('options');
    }
}
