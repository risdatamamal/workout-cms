<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Admin',
                'email' => 'admin@test.com',
                'password' => bcrypt('admin123'),
            ],
            [
                'name' => 'Mamat',
                'email' => 'mamat@test.com',
                'password' => bcrypt('admin123'),
            ],
            [
                'name' => 'Tamam',
                'email' => 'tamam@test.com',
                'password' => bcrypt('admin123'),
            ],
        ];

        foreach ($data as $key => $value) {
            User::create($value);
        }
    }
}
