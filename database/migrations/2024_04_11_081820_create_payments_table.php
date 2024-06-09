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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('nominal')->nullable();
            $table->string('bukti_transfer')->nullable();
            $table->enum('status', ['tervalidasi', 'belum-tervalidasi', 'menunggu-validasi'])->default('menunggu-validasi');
            $table->foreignUuid('id_tagihan')->references('id')->on('tagihan')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
