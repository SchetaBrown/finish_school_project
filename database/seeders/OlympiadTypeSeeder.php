<?php

namespace Database\Seeders;

use App\Models\OlympiadType;
use Illuminate\Database\Seeder;

class OlympiadTypeSeeder extends Seeder
{
    // private array $types = ['индивидуальный', 'командный'];
    private array $types = [
        'командный',
        'индивидуальный',
    ];
    public function run(): void
    {
        foreach ($this->types as $type) {
            OlympiadType::create(['title' => $type]);
        }
    }
}
