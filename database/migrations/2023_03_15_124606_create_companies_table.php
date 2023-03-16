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
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id', true);
            $table->string('name_ar');
            $table->string('name_lt');
            $table->string('legal_form');
            $table->string('type');
            $table->integer('balance');
            $table->string('logo');
            $table->string('address_ar');
            $table->string('address_lt');
            $table->string('email');//->unique();
            $table->string('mobile');//->unique();
            $table->string('tel')->nullable();//->unique();
            $table->string('website')->nullable();
            $table->string('fax')->nullable();
            $table->integer('city_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
