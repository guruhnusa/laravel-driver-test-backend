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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            //user id
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            //score Signs, Generic, Psychologist
            $table->integer('score_signs')->nullable();
            $table->integer('score_generic')->nullable();
            $table->integer('score_psychologist')->nullable();
            //status ujian enum('start','done')
            $table->enum('status_signs', ['start', 'done'])->default('start');
            $table->enum('status_generic', ['start', 'done'])->default('start');
            $table->enum('status_psychologist', ['start', 'done'])->default('start');
            //timer exam
            $table->integer('timer_signs')->nullable();
            $table->integer('timer_generic')->nullable();
            $table->integer('timer_psychologist')->nullable();
            //results
            $table->string('result')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
