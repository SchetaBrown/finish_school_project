<?php

namespace Database\Seeders;

use App\Models\OlympiadType;
use Illuminate\Database\Seeder;

class OlympiadTypeSeeder extends Seeder
{
    private array $types = ['индивидуальный', 'командный'];
    public function run(): void
    {
        foreach ($this->types as $type) {
            OlympiadType::create([
                'title' => $type
            ]);
        }
    }
}
