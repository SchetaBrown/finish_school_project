<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    private array $roles = ['участник', 'руководитель', 'сопровождающий', 'ответственный', 'администратор', 'директор учебного заведения'];
    public function run(): void
    {
        foreach ($this->roles as $role) {
            Role::create([
                'title' => $role
            ]);
        }
    }
}
