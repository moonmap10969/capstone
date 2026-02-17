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
    Schema::create('lessons', function (Illuminate\Database\Schema\Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('subject');
        $table->date('date');
        $table->text('description')->nullable();
        $table->enum('status', ['draft', 'ready', 'completed'])->default('draft');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
