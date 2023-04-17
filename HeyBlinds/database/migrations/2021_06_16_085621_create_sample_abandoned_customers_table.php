<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleAbandonedCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_abandoned_customers', function (Blueprint $table) {
            $table->id();

            $table->string('sample_cart_external_id')->nullable();
            $table->tinyInteger('no_of_sample_blinds')->nullable();
            $table->string('how_to_hear')->nullable();

            $table->string('shipping_first_name')->nullable();
            $table->string('shipping_last_name')->nullable();
            $table->string('shipping_email')->nullable();
            $table->string('shipping_area_code')->nullable();
            $table->string('shipping_phone_number')->nullable();
            $table->string('shipping_street')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_province')->nullable();
            $table->string('shipping_postal_code')->nullable();

            $table->boolean('has_billing')->default(false)->nullable();

            $table->string('billing_first_name')->nullable();
            $table->string('billing_last_name')->nullable();
            $table->string('billing_email')->nullable();
            $table->string('billing_area_code')->nullable();
            $table->string('billing_phone_number')->nullable();
            $table->string('billing_street')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_province')->nullable();
            $table->string('billing_postal_code')->nullable();
            $table->integer('cart_type')->default(0);
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
        Schema::dropIfExists('sample_abandoned_customers');
    }
}
