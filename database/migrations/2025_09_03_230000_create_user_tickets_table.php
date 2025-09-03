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
        Schema::create('user_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ticket_id')->constrained()->cascadeOnDelete();
            $table->string('reference_number')->unique();
            $table->decimal('price', 8, 2);
            $table->enum('status', ['not_scanned', 'scanned', 'expired', 'cancelled'])->default('not_scanned');
            $table->timestamp('scanned_at')->nullable();
            $table->timestamp('purchased_at')->nullable();
            $table->string('payment_reference')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'status']);
            $table->index(['event_id', 'status']);
            $table->index('reference_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_tickets');
    }
};
