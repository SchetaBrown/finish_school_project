<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    private array $cities = [
        'иркутск',
        'братск',
        'ангарск',
        'усть-илимск',
        'усолье-сибирское',
        'черемхово',
        'шелехов',
        'тулун',
        'саянк',
    ];
    public function run(): void
    {
        foreach ($this->cities as $city) {
            City::create([
                'title' => $city
            ]);
        }
    }
}
