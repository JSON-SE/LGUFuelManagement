<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToProductMeasurement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_measurements', function (Blueprint $table) {
            $table->integer('installation_media_id_1')->nullable();
            $table->string('installation_media_id_2', 500)->nullable();
            $table->integer('measure_media_id_1')->nullable();
            $table->string('measure_media_id_2', 500)->nullable();
            $table->integer('motorization_media_id_1')->nullable();
            $table->string('motorization_media_id_2', 500)->nullable();

        });

        Schema::table('product_colors', function (Blueprint $table){
            $table->integer('order_by')->nullable();
            $table->integer('amount_percentage')->nullable();
        });
        Schema::table('product_options', function (Blueprint $table){
            $table->integer('order_by')->nullable();
        });
        Schema::table('product_option_rules', function (Blueprint $table){
            $table->integer('order_by')->nullable();
        });
        Schema::table('options', function (Blueprint $table){
            $table->integer('order_by')->nullable();
        });
        Schema::table('option_groups', function (Blueprint $table){
            $table->integer('order_by')->nullable();
        });
        Schema::table('sub_options', function (Blueprint $table){
            $table->integer('order_by')->nullable();
        });
        Schema::table('carts', function (Blueprint $table){
            $table->string('draft_reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_measurements', function (Blueprint $table) {
            $table->integer('installation_media_id_1')->nullable();
            $table->integer('measure_media_id_1')->nullable();
            $table->integer('motorization_media_id_1')->nullable();
            $table->string('installation_media_id_2')->nullable();
            $table->string('measure_media_id_2')->nullable();
            $table->string('motorization_media_id_2')->nullable();
        });
        Schema::table('products', function (Blueprint $table){
            $table->integer('order_by')->nullable();
        });
        Schema::table('product_colors', function (Blueprint $table){
            $table->integer('order_by')->nullable();
            $table->float('amount_percentage')->nullable();
        });
        Schema::table('product_options', function (Blueprint $table){
            $table->integer('order_by')->nullable();
        });
        Schema::table('product_option_rules', function (Blueprint $table){
            $table->integer('order_by')->nullable();
        });
        Schema::table('options', function (Blueprint $table){
            $table->integer('order_by')->nullable();
            $table->integer('tooltip_media_id')->nullable();
        });
        Schema::table('option_groups', function (Blueprint $table){
            $table->integer('order_by')->nullable();
        });
        Schema::table('sub_options', function (Blueprint $table){
            $table->integer('order_by')->nullable();
        });
    }
}
