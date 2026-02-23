<?php

namespace Database\Seeders;

use App\Models\OlympiadDirection;
use Illuminate\Database\Seeder;

class OlympiadDirectionSeeder extends Seeder
{
    // private array $directions = ['программирование', 'математика', 'иностранный язык'];
    private array $directions = [
        [
            'title' => 'программирование',
            'slug' => 'programmirovanie',
        ],
        [
            'title' => 'математика',
            'slug' => 'matematika',
        ],
        [
            'title' => 'иностранный язык',
            'slug' => 'inostranniy-yazik',
        ],
    ];
    public function run(): void
    {
        foreach ($this->directions as $direction) {
            OlympiadDirection::create($direction);
        }
    }
}
