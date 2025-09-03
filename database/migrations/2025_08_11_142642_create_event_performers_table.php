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
        Schema::create('event_performers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('performer_id')->constrained()->onDelete('cascade');
            $table->integer('performance_order')->nullable();
            $table->time('performance_time')->nullable();
            $table->integer('duration_minutes')->nullable();
            $table->text('special_notes')->nullable();
            $table->timestamps();

            $table->unique(['event_id', 'performer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_performers');
    }
};
