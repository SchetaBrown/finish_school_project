<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            EducationSchoolSeeder::class,
            EducationDirectionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            OlympiadStatusSeeder::class,
            OlympiadTypeSeeder::class,
            OlympiadDirectionSeeder::class,
            OlympiadSeeder::class,
            ParticipantSeeder::class,
            EducationManagerSeeder::class,
            OlympiadNewSeeder::class,
            OlympiadOrderStatusSeeder::class
        ]);
    }
}
