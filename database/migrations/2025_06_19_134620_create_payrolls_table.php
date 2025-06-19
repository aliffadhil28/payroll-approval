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
        Schema::create('payroll_request', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payroll_id')->constrained()->onDelete('cascade');
            $table->decimal('bonus', 10, 2)->nullable();
            $table->decimal('tax', 10, 2);
            $table->decimal('net_pay', 10, 2);
            $table->enum('status', ['pending', 'approved', 'rejected','processed'])->default('pending');
            $table->string('payment_slip')->nullable()->comment('nama file bukti pembayaran gaji');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('processed_by')->nullable();
            $table->string('action_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_request');
    }
};
