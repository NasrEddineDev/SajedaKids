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
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id', true);
            $table->string('firstname_ar');
            $table->string('lastname_ar');
            $table->string('firstname_lt');
            $table->string('lastname_lt');
            $table->string('mobile');
            $table->enum('gender', ['MALE', 'FEMALE'])->nullable();
            $table->string('birthday');
            $table->string('address_ar');
            $table->string('address_lt');
            $table->string('signature');
            $table->string('image');
            $table->string('language');
            $table->string('theme');
            $table->integer('city_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
