<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('rating_point')->default(0);
            $table->string('title_review')->nullable();
            $table->string('name')->nullable();
            $table->text('review')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->text('customer_suggestion')->nullable();
            $table->bigInteger('order_by')->default(0);
            $table->boolean('status')->default(1);
            $table->boolean('show_home_page')->default(1);
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
        Schema::dropIfExists('reviews');
    }
}
