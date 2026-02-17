<?php

namespace Database\Seeders;

use App\Models\OlympiadDirection;
use Illuminate\Database\Seeder;

class OlympiadDirectionSeeder extends Seeder
{
    private array $directions = ['программирование', 'математика', 'иностранный язык'];
    public function run(): void
    {
        foreach ($this->directions as $direction) {
            OlympiadDirection::create([
                'title' => $direction
            ]);
        }
    }
}
