<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubpromosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subpromos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('promo_id')->unsigned();
            $table->bigInteger('sub_categories_id')->unsigned()->nullable();
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->enum('promo_type',['percentage','fixed_amount','free_shipping']);
            $table->double('discount','8,2')->default(0);
            $table->double('extra_discount','8,2')->default(0);
            $table->foreign('promo_id')->references('id')->on('promos')->cascadeOnDelete();
             $table->foreign('product_id')->references('id')->on('products');
             $table->foreign('sub_categories_id')->references('id')->on('sub_categories');
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
        Schema::dropIfExists('subpromos');
    }
}
