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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id');
            $table->integer('rack_dt_id');
            $table->double('item_qty');
            $table->string('description')->nullable();
            $table->date('date')->nullable();
            $table->string('clock')->nullable();
            $table->string('product_origin')->nullable();
            $table->date('expired_date')->nullable();
            $table->date('production_date')->nullable();
            $table->double('item_weight')->nullable();
            $table->timestamps();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
};
