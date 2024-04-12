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
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('nisn', 10)->unique();
            $table->string('name', 100);
            $table->enum('gender', ['male', 'female']);
            $table->date('date_of_birth');
            $table->enum('religion', ['islam', 'christianity', 'catholicism', 'hinduism', 'buddhism', 'confucianism']);
            $table->enum('orphan_status', ['orphan_both', 'orphan_father', 'orphan_mother', 'none']);
            $table->string('phone_number', 25);
            $table->text('address');
            $table->foreignUuid('classroom_id')->references('id')->on('classrooms')->cascadeOnDelete();
            $table->foreignUuid('student_parent_id')->references('id')->on('student_parents')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
