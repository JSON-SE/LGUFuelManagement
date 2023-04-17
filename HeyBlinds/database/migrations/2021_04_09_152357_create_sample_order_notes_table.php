<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleOrderNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_order_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sample_order_id')->nullable();
            $table->foreign('sample_order_id')->references('id')->on('sample_orders')->nullOnDelete();
            $table->enum('receiver', ['customer', 'vendor'])->nullable();
            $table->text('note')->nullable();
            $table->boolean('is_active')->nullable();
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
        Schema::dropIfExists('sample_order_notes');
    }
}
