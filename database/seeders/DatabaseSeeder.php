<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // WithoutModelEvents::class;
        $this->call([
            UserSeeder::class,
            QuestionSeeder::class,
            SignSeeder::class,
            ContentSeeder::class,
            ExamSeeder::class,
            ExamQuestionListSeeder::class,
            VideoSeeder::class,
        ]);
    }
}
