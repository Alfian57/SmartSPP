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
        Schema::create('tagihan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('nominal');
            $table->enum('bulan', ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december']);
            $table->string('tahun_ajaran', 10);
            $table->unsignedBigInteger('diskon')->default(0);
            $table->foreignUuid('id_siswa')->references('id')->on('siswa')->cascadeOnDelete();
            $table->enum('status', ['dibayar', 'belum-dibayar'])->default('belum-dibayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan');
    }
};
