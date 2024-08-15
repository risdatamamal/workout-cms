<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
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
                'guard_name' => 'web',
            ],
            [
                'name' => 'Trainer',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Customer',
                'guard_name' => 'web',
            ],
        ];

        foreach ($data as $key => $value) {
            \DB::table('roles')->insert($value);
        }
    }
}
