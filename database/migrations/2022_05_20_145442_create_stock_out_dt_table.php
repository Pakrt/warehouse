<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_out_dt', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_out_id')->references('id')->on('stock_out');
            $table->foreignId('item_id')->references('id')->on('items');
            $table->string('qty');
            $table->date('date');
            $table->timestamps();
            $table->foreignId('created_by')->nullable()->references('id')->on('users');
            $table->foreignId('updated_by')->nullable()->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_out_dt');
    }
};
