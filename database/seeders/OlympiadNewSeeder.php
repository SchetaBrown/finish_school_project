<?php

namespace Database\Seeders;

use App\Models\OlympiadNew;
use Illuminate\Database\Seeder;

class OlympiadNewSeeder extends Seeder
{
    private array $news = [
        [
            'title' => 'Олимпиада отменена',
            'description' => 'В связи с отсутсвием...',
            'user_id' => 1,
            'olympiad_id' => 1,
            'published_at' => '2025-11-23 12:31:55',
        ]
    ];
    public function run(): void
    {
        foreach ($this->news as $new) {
            OlympiadNew::create($new);
        }
    }
}
