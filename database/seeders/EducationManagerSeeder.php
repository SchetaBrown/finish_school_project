<?php

namespace Database\Seeders;

use App\Models\EducationManager;
use Illuminate\Database\Seeder;

class EducationManagerSeeder extends Seeder
{
    private array $managers = [
        [
            'is_accept' => true,
            'user_id' => 3,
            'education_school_id' => 1,
        ],
    ];
    public function run(): void
    {
        foreach ($this->managers as $manager) {
            EducationManager::create($manager);
        }
    }
}
