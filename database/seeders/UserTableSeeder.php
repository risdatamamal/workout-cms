<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Jonathan',
                'email' => 'jonathan@test.com',
                'password' => bcrypt('admin123'),
            ],
            [
                'name' => 'Clarissa',
                'email' => 'clarissa@test.com',
                'password' => bcrypt('admin123'),
            ],
            [
                'name' => 'Saskiya',
                'email' => 'saskiya@test.com',
                'password' => bcrypt('admin123'),
            ],
        ];

        foreach ($data as $key => $value) {
            User::create($value);
        }
    }
}
