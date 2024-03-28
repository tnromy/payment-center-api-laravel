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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('ava')->default('contacts/default.png');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable()->unique();
            $table->string('whatsapp')->nullable()->unique();
            $table->string('telegram')->nullable()->unique();
            $table->string('tel')->nullable()->unique();
            $table->string('addr_detail')->nullable();
            $table->string('addr_pos_code')->nullable();
            $table->string('location_code')->nullable();
            $table->dateTime('last_use')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
