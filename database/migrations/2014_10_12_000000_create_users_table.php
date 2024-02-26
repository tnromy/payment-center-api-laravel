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
           $table->uuid('user_id');
           $table->primary('user_id');
            $table->string('username');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('tel')->nullable();
            $table->string('password')->nullable();
            $table->boolean('user_is_active')->default(true);
            $table->boolean('user_remember_me')->default(true);
            $table->string('user_added_by_user_id')->nullable();
            $table->string('user_updated_by_user_id')->nullable();
            $table->string('user_deleted_by_user_id')->nullable();
            $table->ipAddress('user_added_by_ip_addr')->nullable();
            $table->ipAddress('user_updated_by_ip_addr')->nullable();
            $table->ipAddress('user_deleted_by_ip_addr')->nullable();
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
