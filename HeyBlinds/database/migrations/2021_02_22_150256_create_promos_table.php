<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('external_id');
            $table->string('name', 250)->nullable();
            $table->string('code', 250)->nullable();
            $table->enum('discount_type', ['percentage', 'fixed_amount', 'free_shipping'])->nullable();
            $table->float('amount')->nullable();
            $table->float('extra_amount')->nullable();
            $table->enum('discount_category', ['site-wide', 'fixed_amount', 'per-product'])->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->unsignedBigInteger('promo_banner')->nullable();
            $table->foreign('promo_banner')->references('id')->on('media')->nullOnDelete();
            $table->string('banner_link', 1000)->nullable();
            $table->string('ticker', 1000)->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('hide_timer')->default(true);
            $table->boolean('is_predefined')->default(true);
            $table->boolean('is_delete')->default(false);
            $table->text('category')->nullable();
            $table->text('product')->nullable();
            $table->text('content')->nullable();
            $table->text('mob_text_bar')->nullable();
            $table->text('coupon_text_box')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('promos');
    }
}
