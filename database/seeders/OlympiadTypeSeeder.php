<?php

namespace Database\Seeders;

use App\Models\OlympiadType;
use Illuminate\Database\Seeder;

class OlympiadTypeSeeder extends Seeder
{
    // private array $types = ['индивидуальный', 'командный'];
    private array $types = [
        [
            'title' => 'индивидуальный',
            'slug' => 'individualniy',
        ],
        [
            'title' => 'командный',
            'slug' => 'komandniy',
        ],
    ];
    public function run(): void
    {
        foreach ($this->types as $type) {
            OlympiadType::create($type);
        }
    }
}
