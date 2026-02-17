<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    private array $users = [
        [
            'surname' => 'Иванов',
            'name' => 'Иван',
            'patronymic' => 'Иванович',
            'email' => 'ivan@example.com',
            'password' => '123123123',
        ],
        [
            'surname' => 'Петров',
            'name' => 'Петр',
            'patronymic' => 'Петрович',
            'email' => 'petr@example.com',
            'password' => '123123123',
        ],
    ];
    public function run(): void
    {
        foreach ($this->users as $user) {
            User::create($user);
        }
    }
}
