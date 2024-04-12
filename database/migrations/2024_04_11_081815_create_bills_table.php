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
        Schema::create('bills', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('nominal');
            $table->enum('month', ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december']);
            $table->string('school_year', 10);
            $table->unsignedBigInteger('disccount')->default(0);
            $table->foreignUuid('student_id')->references('id')->on('students')->cascadeOnDelete();
            $table->enum('status', ['paid-off', 'not-paid-off'])->default('not-paid-off');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
