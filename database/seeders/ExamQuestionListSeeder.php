<?php

namespace Database\Seeders;

use App\Models\ExamQuestionLists;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamQuestionListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExamQuestionLists::factory()
            ->count(10)
            ->create();
    }
}
