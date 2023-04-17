<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeadrailOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('headrail_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->boolean('left_side_left')->default(1);
            $table->boolean('left_side_right')->default(1);
            $table->boolean('left_side_both')->default(1);
            $table->boolean('right_side_left')->default(1);
            $table->boolean('right_side_right')->default(1);
            $table->boolean('right_side_both')->default(1);
            $table->boolean('is_separate_blinds')->default(0);
            $table->boolean('left_status')->default(1);
            $table->boolean('right_status')->default(1);
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
        Schema::dropIfExists('headrail_options');
    }
}
