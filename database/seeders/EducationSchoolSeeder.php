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
            'phone' => '79998887766',
            'email' => 'iat@iat.com',
            'director_surname' => 'Userov',
            'director_name' => 'User',
            'director_patronymic' => 'Userovich',
        ],
        [
            'full_name' => 'Колледж Байкальского государственного университета',
            'short_name' => 'Колледж БГУ',
            'inn' => '3808011538',
            'phone' => '79998887767',
            'email' => 'info@bgu.ru',
            'director_surname' => 'Userov',
            'director_name' => 'User',
            'director_patronymic' => 'Userovich',
        ],
    ];
    public function run(): void
    {
        foreach ($this->schools as $school) {
            EducationSchool::create($school);
        }
    }
}
