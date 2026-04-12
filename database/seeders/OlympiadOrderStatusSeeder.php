<?php

namespace Database\Seeders;

use App\Models\OlympiadOrderStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OlympiadOrderStatusSeeder extends Seeder
{
    private array $statuses = ['на рассмотрении', 'принято', 'отклонено'];

    public function run(): void
    {
        foreach ($this->statuses as $status) {
            OlympiadOrderStatus::create([
                'title' => $status,
                'slug' => Str::slug($status),
            ]);
        }
    }
}
