<?php

namespace Database\Seeders;

use App\Models\OlympiadOrderStatus;
use Illuminate\Database\Seeder;

class OlympiadOrderStatusSeeder extends Seeder
{
    private array $statuses = [
        [
            'title' => 'на рассмотрении',
            'slug' => 'for_consideration',
        ],
        [
            'title' => 'принято',
            'slug' => 'accepted',
        ],
        [
            'title' => 'отклонено',
            'slug' => 'rejected',
        ],
    ];

    public function run(): void
    {
        foreach ($this->statuses as $status) {
            OlympiadOrderStatus::create($status);
        }
    }
}
