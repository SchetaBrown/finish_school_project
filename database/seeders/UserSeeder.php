<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{


    public function run(): void
    {
        $users = [
            [
                'surname' => 'Иванов',
                'name' => 'Иван',
                'patronymic' => 'Иванович',
                'email' => 'ivan@gmail.com',
                'phone' => '7999887766',
                'password' => '123123123',
                'email_verified_at' => now(),
                'role_id' => 1,
            ],
            [
                'surname' => 'Петров',
                'name' => 'Петр',
                'patronymic' => 'Петрович',
                'email' => 'petr@gmail.com',
                'phone' => '7999887767',
                'password' => '123123123',
                'email_verified_at' => now(),
                'role_id' => 1,
            ],
            [
                'surname' => 'Managerov',
                'name' => 'Manager',
                'patronymic' => 'Managerovich',
                'email' => 'manager@gmail.com',
                'phone' => '7999887763',
                'password' => '123123123',
                'email_verified_at' => now(),
                'role_id' => 2,
            ],
            [
                'surname' => 'Maintainerov',
                'name' => 'Maintainer',
                'patronymic' => 'Maintainerovich',
                'email' => 'maintainer@gmail.com',
                'phone' => '7999887760',
                'password' => '123123123',
                'email_verified_at' => now(),
                'role_id' => 3,
            ],
            [
                'surname' => 'Olympiadov',
                'name' => 'Manager',
                'patronymic' => 'Managerovich',
                'email' => 'olympiadmanager@gmail.com',
                'phone' => '7999887761',
                'password' => '123123123',
                'email_verified_at' => now(),
                'role_id' => 4,
            ],
            [
                'surname' => 'Adminov',
                'name' => 'Admin',
                'patronymic' => 'Adminovich',
                'email' => 'admin@gmail.com',
                'phone' => '79998889988',
                'password' => 'admin',
                'email_verified_at' => now(),
                'role_id' => 5,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
