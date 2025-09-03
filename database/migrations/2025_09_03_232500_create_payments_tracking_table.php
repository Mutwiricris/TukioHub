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
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('reference_number')->unique();
            $table->enum('payment_method', ['mpesa', 'card', 'bank_transfer', 'cash'])->default('mpesa');
            $table->enum('status', ['pending', 'confirmed', 'reversed', 'failed'])->default('pending');
            $table->decimal('amount', 10, 2);
            $table->json('payment_details')->nullable(); // Store method-specific details
            $table->string('external_reference')->nullable(); // External payment gateway reference
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('reversed_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'status']);
            $table->index(['payment_method', 'status']);
            $table->index('reference_number');
            $table->index('external_reference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_transactions');
    }
};
