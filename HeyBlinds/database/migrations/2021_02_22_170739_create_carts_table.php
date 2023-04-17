<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('cart_id')->unique()->nullable();
            $table->string('external_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->float('cart_amount')->default(0);
            $table->float('cart_item_discount')->default(0);
            $table->float('cart_total_price')->default(0);
            $table->string('coupon')->nullable();
            $table->text('cart_tax')->nullable();
            $table->string('coupon_type')->nullable();
            $table->float('discount')->default(0);
            $table->boolean('cart_draft')->default(false);

            // $table->float('grand_total_price')->default(0);
            $table->boolean('is_delete')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('carts');
    }
}
