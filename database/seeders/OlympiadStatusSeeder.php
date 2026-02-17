<?php

namespace Database\Seeders;

use App\Models\OlympiadStatus;
use Illuminate\Database\Seeder;

class OlympiadStatusSeeder extends Seeder
{
    private array $statuses = ['черновик', 'открыта регистрация', 'регистрация закрыта', 'завершено'];
    public function run(): void
    {
        foreach ($this->statuses as $status) {
            OlympiadStatus::create([
                'title' => $status
            ]);
        }
    }
}
