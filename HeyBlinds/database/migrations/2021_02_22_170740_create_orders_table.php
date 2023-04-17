<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->unsignedBigInteger('cart_id')->nullable();
            $table->foreign('cart_id')->references('id')->on('carts')->nullOnDelete();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->smallInteger('order_status')->default(1);
            $table->float('order_amount')->default(0);
            $table->float('order_item_discount')->nullable();
            $table->text('order_tax')->nullable();
            $table->float('order_shipping')->default(0);
            $table->float('order_total_price')->default(0);
            $table->string('promo')->nullable();
            $table->boolean('google_review_status')->default(0);
            $table->float('discount')->default(0);
            $table->float('grand_total_price')->default(0);
            $table->dateTime('order_date')->nullable();
            $table->boolean('order_shipped')->nullable();
            $table->string('order_tracking_number')->nullable();
            $table->boolean('is_delete')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->text('content')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
