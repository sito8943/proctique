<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Report;
use App\Models\Review;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Tag::factory(10)->create();
        Report::factory(10)->create();
        Review::factory(10)->create();
        Project::factory(10)->create();
    }
}
