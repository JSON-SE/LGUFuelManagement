<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleOrderEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_order_entries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sample_order_id')->nullable();
            $table->foreign('sample_order_id')->references('id')->on('sample_orders')->nullOnDelete();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->nullOnDelete();
            $table->string('name')->nullable();
            $table->date('estimated_shipping_date')->nullable();
            $table->string('room')->nullable();
            $table->string('mount_type')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('color_id')->nullable();
            $table->string('color_name')->nullable();
            $table->string('lift')->nullable();
            $table->string('headrail')->nullable();
            $table->string('valance')->nullable();
            $table->string('bottom_trim')->nullable();
            $table->string('warranty')->nullable();
            $table->smallInteger('quantity')->default(0);
            $table->string('note')->nullable();
            $table->boolean('is_active')->nullable();
            $table->boolean('is_delete')->nullable();
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
        Schema::dropIfExists('sample_order_entries');
    }
}
