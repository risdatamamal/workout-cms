<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleHasPermissionTableSeeder extends Seeder
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
                'permission_id' => 3,
                'role_id' => 1,
            ],
            [
                'permission_id' => 2,
                'role_id' => 1,
            ],
            [
                'permission_id' => 1,
                'role_id' => 1,
            ],
            [
                'permission_id' => 4,
                'role_id' => 2,
            ],
            [
                'permission_id' => 5,
                'role_id' => 3,
            ],
        ];

        foreach ($data as $key => $value) {
            \DB::table('role_has_permissions')->insert($value);
        }
    }
}
