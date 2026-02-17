<?php

namespace Database\Seeders;

use App\Models\EducationSchool;
use Illuminate\Database\Seeder;

class EducationSchoolSeeder extends Seeder
{
    private array $schools = [
        [
            'full_name' => 'Государственное бюджетное профессиональное образовательное учреждение Иркутской области «Иркутский авиационный техникум»',
            'short_name' => 'ГБПОУИО "ИАТ"',
            'inn' => '3808015469',
            'phone' => '+7(999) 888-77-66',
            'email' => 'iat@iat.com',
            'city_id' => 1,
            'director_id' => 2,
        ],
    ];
    public function run(): void
    {
        foreach ($this->schools as $school) {
            EducationSchool::create($school);
        }
    }
}
