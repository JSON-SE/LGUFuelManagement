<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('external_id')->nullable();
            $table->string('name')->nullable();
            $table->string('sku')->nullable();
            $table->bigInteger('stock')->nullable();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('features')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->nullOnDelete();
            $table->integer('default_width')->nullable();
            $table->integer('default_height')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('video_url')->nullable();
            $table->text('video_id')->nullable();
            $table->integer('display_media_id')->nullable();
            $table->text('slider_id')->nullable();
            $table->text('content')->nullable();
            $table->decimal('unit_price')->nullable();
            $table->decimal('mrp')->nullable();
            $table->decimal('sales_price')->nullable();
            $table->double('headrail_price')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->bigInteger('order_by')->nullable();
            $table->boolean('is_active')->default(true)->nullable();
            $table->boolean('is_live')->default(true)->nullable();
            $table->boolean('is_on_sale')->default(false)->nullable();
            $table->boolean('is_new')->default(false)->nullable();
            $table->boolean('is_feature')->default(false)->nullable();
            $table->boolean('show_home_page')->default(false)->nullable();
            $table->boolean('draft')->default(false)->nullable();
            $table->bigInteger('home_media_id')->nullable();
            
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
        Schema::dropIfExists('products');
    }
}
