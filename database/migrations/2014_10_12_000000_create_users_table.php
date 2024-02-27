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
           $table->uuid('id');
           $table->primary('id');
            $table->string('username');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('password')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('remember_me')->default(true);
            $table->string('added_by_user_id')->nullable();
            $table->string('updated_by_user_id')->nullable();
            $table->string('deleted_by_user_id')->nullable();
            $table->ipAddress('added_by_ip_addr')->nullable();
            $table->ipAddress('updated_by_ip_addr')->nullable();
            $table->ipAddress('deleted_by_ip_addr')->nullable();
            $table->softDeletes();
            $table->timestamps();
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
