<?php

namespace Database\Seeders;

use App\Models\OlympiadNew;
use Illuminate\Database\Seeder;

class OlympiadNewSeeder extends Seeder
{
    private array $news = [
        [
            'title' => 'Опубликованы задания прошлых лет',
            'description' => 'Для подготовки к олимпиаде вы можете ознакомиться с заданиями и решениями прошлого года в личном кабинете. Материалы доступны для скачивания.',
            'slug' => '',
            'user_id' => 1,
            'olympiad_id' => 1,
            'published_at' => '2026-04-15 12:31:55',
        ],
        [
            'title' => 'Олимпиада отменена',
            'description' => 'В связи с отсутсвием...',
            'slug' => '',
            'user_id' => 1,
            'olympiad_id' => 1,
            'published_at' => '2025-11-23 12:31:55',
        ],
    ];
    public function run(): void
    {
        foreach ($this->news as $new) {
            OlympiadNew::create($new);
        }
    }
}
