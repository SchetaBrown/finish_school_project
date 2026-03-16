<?php

namespace Database\Seeders;

use App\Models\Manager;
use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder
{
    private array $managers = [
        [
            'is_accept' => true,
            'user_id' => 2,
            'education_school_id' => 1,
        ]
    ];
    public function run(): void
    {
        foreach ($this->managers as $manager) {
            Manager::create($manager);
        }
    }
}
