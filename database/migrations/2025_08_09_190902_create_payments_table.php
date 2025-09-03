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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('KES');
            $table->string('payment_method'); // mpesa, card, airtel_money, bank_transfer
            $table->enum('payment_status', ['pending', 'processing', 'completed', 'failed', 'refunded', 'pending_verification'])->default('pending');
            $table->string('payment_reference')->unique();
            $table->string('external_transaction_id')->nullable();
            $table->string('phone_number')->nullable(); // For mobile payments
            $table->json('payment_details')->nullable(); // Additional payment info
            $table->json('gateway_response')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
