<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_orders', function (Blueprint $table) {
            $table->id();
            $table->string('sample_order_id')->nullable();
            $table->string('sample_cart_external_id')->nullable();
            $table->string('cart_external_id')->nullable();
            $table->unsignedBigInteger('sample_cart_id')->nullable();
            $table->foreign('sample_cart_id')->references('id')->on('sample_carts')->nullOnDelete();
            $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('customers')->nullOnDelete();
            $table->boolean('shipping_type')->nullable();
            $table->boolean('is_have_billing')->nullable();
            $table->integer('card_number')->nullable();
            $table->integer('card_name')->nullable();
            $table->string('card_expiry')->nullable();
            $table->integer('card_cvc')->nullable();
            $table->string('hear_us')->nullable();
            $table->string('order_date')->nullable();
            $table->text('payment_response')->nullable();
            $table->string('no_of_windows')->nullable();
            $table->string('order_shipped')->nullable();
            $table->boolean('order_status')->default(1);
            $table->boolean('order_cart_status')->default(0);
            $table->string('order_tracking_number')->nullable();
            $table->boolean('is_delete')->nullable();
            $table->boolean('is_active')->nullable();
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
        Schema::dropIfExists('sample_orders');
    }
}
