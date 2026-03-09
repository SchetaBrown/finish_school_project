<?php

namespace Database\Seeders;

use App\Models\Participant;
use Illuminate\Database\Seeder;

class ParticipantSeeder extends Seeder
{
    private array $participants = [
        [
            'birth_date' => '2007-07-07',
            'cours_number' => 4,
            'user_id' => 1,
            'education_school_id' => 1,
        ]
    ];
    public function run(): void
    {
        foreach ($this->participants as $participant) {
            Participant::create($participant);
        }
    }
}
