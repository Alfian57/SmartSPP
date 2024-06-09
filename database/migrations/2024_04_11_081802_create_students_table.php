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
        Schema::create('siswa', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('nisn', 10)->unique();
            $table->string('nama', 100);
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->date('tanggal_lahir');
            $table->enum('agama', ['islam', 'kristen', 'katholik', 'hindu', 'budha', 'konghuchu']);
            $table->enum('status', ['yatim-piatu', 'yatim', 'piatu', 'none']);
            $table->string('no_telepon', 25);
            $table->text('alamat');
            $table->foreignUuid('id_kelas')->references('id')->on('kelas')->cascadeOnDelete();
            $table->foreignUuid('id_orang_tua')->references('id')->on('orang_tua')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
