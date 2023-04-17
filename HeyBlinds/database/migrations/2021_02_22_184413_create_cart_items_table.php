<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id')->nullable();
            $table->foreign('cart_id')->references('id')->on('carts')->nullOnDelete();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->nullOnDelete();
            $table->float('sub_total',8,2)->default(0);
            $table->float('unit_price',8,2)->default(0);
            $table->integer('quantity')->default(1);
            $table->float('purchase_price');
            $table->integer('coupon_id')->nullable();
            $table->float('discount_amount',8,2)->default(0);
            $table->string('promo_name')->nullable();
            $table->string('promo_discount')->nullable();
            $table->string('promo_type')->nullable();
            $table->float('promo_price')->nullable();
            $table->string('option_name');
            $table->text('option_value')->nullable();
            $table->text('customer_note')->nullable();
            $table->string('room_name')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('cart_items');
    }
}
