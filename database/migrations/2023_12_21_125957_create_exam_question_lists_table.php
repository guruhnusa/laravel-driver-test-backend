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
        Schema::create('exam_question_lists', function (Blueprint $table) {
            $table->id();
            //exam id
            $table->foreignId('exam_id')->constrained()->onDelete('cascade');
            //question id
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            //answer boolean
            $table->boolean('answer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_question_lists');
    }
};
