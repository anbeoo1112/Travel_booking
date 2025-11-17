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
            $table->uuid('id')->primary();
            $table->string('booking_id')->index();
            $table->foreign('booking_id')->references('id')->on('dat_tour')->onDelete('cascade');

            $table->string('gateway', 50)->default('payos'); // payos, vnpay, momo, etc.
            $table->string('order_code')->unique();
            $table->decimal('amount', 15, 2);
            $table->string('currency', 3)->default('VND');

            $table->enum('status', ['pending', 'processing', 'succeeded', 'failed', 'canceled'])->default('pending');
            $table->string('txn_id')->nullable(); // transaction ID từ gateway
            $table->json('meta')->nullable(); // toàn bộ payload từ webhook

            $table->string('return_code')->nullable();
            $table->boolean('signature_valid')->default(false);
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();

            $table->index(['booking_id', 'status']);
            $table->index('order_code');
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
