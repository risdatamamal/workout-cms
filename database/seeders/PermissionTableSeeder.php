<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
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
                'name' => 'manage_role',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage_permission',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage_user',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage_trainer',
                'guard_name' => 'mobile',
            ],
            [
                'name' => 'manage_customer',
                'guard_name' => 'mobile',
            ],
        ];

        foreach ($data as $key => $value) {
            \DB::table('permissions')->insert($value);
        }
    }
}
