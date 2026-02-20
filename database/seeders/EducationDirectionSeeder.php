<?php

namespace Database\Seeders;

use App\Models\EducationDirection;
use Illuminate\Database\Seeder;

class EducationDirectionSeeder extends Seeder
{
    private array $directions = [
        [
            'code' => '09.02.01',
            'title' => 'Компьютерные системы и комплексы',
        ],
        [
            'code' => '09.02.07',
            'title' => 'Информационные систмы и программирование',
        ],
        [
            'code' => '15.02.16',
            'title' => 'Технологии машиностроения',
        ],
        [
            'code' => '24.02.01',
            'title' => 'Производство летательных аппаратов',
        ],
    ];
    public function run(): void
    {
        foreach ($this->directions as $direction) {
            EducationDirection::create($direction);
        }
    }
}
