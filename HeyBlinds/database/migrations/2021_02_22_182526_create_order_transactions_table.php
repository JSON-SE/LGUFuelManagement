<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->nullOnDelete();
            $table->string('invoice_id')->nullable();
            $table->date('payment_date')->nullable();
            $table->float('payment_amount',8,2)->default(0);
            $table->string('payment_status')->nullable();
            $table->boolean('is_delete')->default(false);
            $table->boolean('is_active')->default(true);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('customer_payment_method_id')->nullable();
            $table->string('card_type', 20)->nullable();
            $table->string('card_number', 20)->nullable();
            $table->string('exp_date', 10)->nullable();
            $table->string('txn_number')->nullable();
            $table->string('reference_num')->nullable();
            $table->string('message')->nullable();
            $table->text('response')->nullable();
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
        Schema::dropIfExists('order_transactions');
    }
}
