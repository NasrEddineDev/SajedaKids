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
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->increments('id', true);
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')
                  ->on('roles')->onDelete('cascade');        
            $table->integer('permission_id')->unsigned();
            $table->foreign('permission_id')->references('id')
                  ->on('permissions')->onDelete('cascade');
                  $table->timestamps();
                  $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permissions');
    }
};
