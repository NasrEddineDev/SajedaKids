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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id', true);
            $table->string('code');
            $table->string('SKU');
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('name_fr');
            $table->string('active');
            $table->string('image');
            $table->string('brand');
            $table->string('category');
            $table->integer('price');
            $table->integer('discount');
            $table->string('description');
            $table->integer('store_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            // $table->id();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
