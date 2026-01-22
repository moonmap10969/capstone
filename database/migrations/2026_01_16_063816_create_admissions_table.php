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
   Schema::create('admissions', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('application_id')->unique(); // Temporary ID
    $table->string('student_first_name');
    $table->string('student_last_name');
    $table->date('date_of_birth');
    $table->string('grade_applied');
    $table->string('parent_first_name');
    $table->string('parent_last_name');
    $table->string('email');
    $table->string('phone');
    $table->string('street');
    $table->string('city');
    $table->string('state');
    $table->string('zip');
    $table->string('birth_certificate')->nullable();
    $table->string('immunization_records')->nullable();
    $table->string('report_card')->nullable();
    $table->string('good_moral')->nullable();
    $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
    $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};
