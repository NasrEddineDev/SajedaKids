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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id', true);
            $table->string('name');//->unique();
            $table->string('email');//->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('role_id')->unsigned();
            $table->integer('store_id')->unsigned()->nullable();
            $table->integer('company_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->rememberToken();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
