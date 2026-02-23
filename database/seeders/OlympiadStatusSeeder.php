<?php

namespace Database\Seeders;

use App\Models\OlympiadStatus;
use Illuminate\Database\Seeder;

class OlympiadStatusSeeder extends Seeder
{
    // private array $statuses = ['черновик', 'открыта регистрация', 'регистрация закрыта', 'завершено'];
    private array $statuses = [
        [
            'title' => 'черновик',
            'slug' => 'chernovick',
        ],
        [
            'title' => 'открыта регистрация',
            'slug' => 'otkrita-registratsiya',
        ],
        [
            'title' => 'регистрация закрыта',
            'slug' => 'registratsiya-zakrita',
        ],
        [
            'title' => 'завершено',
            'slug' => 'zaversheno',
        ],
    ];


    public function run(): void
    {
        foreach ($this->statuses as $status) {
            OlympiadStatus::create($status);
        }
    }
}
