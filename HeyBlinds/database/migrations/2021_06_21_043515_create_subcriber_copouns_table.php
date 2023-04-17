<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcriberCopounsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcriber_copouns', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->nullable();
            $table->string('code')->unique();
            $table->enum('type', ['percentage', 'flat'])->nullable();
            $table->float('amount',8,2)->nullable();
            $table->float('min_amount',8,2)->nullable();
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->string('coupon_use')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('pre_applied')->default(false);
            $table->string('coupon_for')->nullable();
            $table->string('promo_discount')->nullable();
            $table->string('promo_type')->nullable();
            $table->boolean('is_active')->default(true);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('subcriber_copouns');
    }
}
