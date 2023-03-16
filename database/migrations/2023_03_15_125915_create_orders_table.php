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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id', true);
            $table->string('status');
            $table->string('date');
            $table->string('description');
            $table->string('type');
            $table->double('net_amount');
            $table->double('tax');
            $table->double('total_amount');
            $table->integer('user_id')->unsigned();
            $table->integer('customer_id')->unsigned()->nullable();
            $table->integer('store_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->rememberToken();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
