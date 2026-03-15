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
            'email' => 'ivan@gmail.com',
            'phone' => '7999887766',
            'password' => '123123123',
        ],
        [
            'surname' => 'Петров',
            'name' => 'Петр',
            'patronymic' => 'Петрович',
            'email' => 'petr@gmail.com',
            'phone' => '7999887767',
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
