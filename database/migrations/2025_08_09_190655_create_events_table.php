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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('venue_id')->constrained()->onDelete('cascade');
            $table->foreignId('organizer_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('title')->nullable(); // For backward compatibility
            $table->text('description');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->string('image_url')->nullable();
            $table->enum('status', ['draft', 'published', 'cancelled', 'completed'])->default('draft');
            $table->integer('max_capacity')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->string('slug')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
