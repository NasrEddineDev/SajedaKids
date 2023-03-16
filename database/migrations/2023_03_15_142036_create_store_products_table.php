<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('store_products', function (Blueprint $table) {
            $table->increments('id', true);
            $table->double('quantity');
            $table->double('price');
            $table->string('description');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')
                  ->on('products')->onDelete('cascade');
            $table->integer('store_id')->unsigned();
            $table->foreign('store_id')->references('id')
                  ->on('stores')->onDelete('cascade');
                  $table->timestamps();
                  $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_products');
    }
};
