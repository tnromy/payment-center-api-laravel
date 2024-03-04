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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->nullable()->constrained();
            $table->foreignIdFor(App\Models\Email::class);
            $table->foreignIdFor(App\Models\User::class);
            $table->foreignIdFor(App\Models\Alias::class);
            $table->string('to');
            $table->string('subject');
            $table->string('body');
            $table->json('attachment')->default("[]");
            $table->boolean('is_read')->default(false);
            $table->foreignId('job_id')->nullable()->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
