<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModelHasRoleTableSeeder extends Seeder
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
                'role_id' => 1,
                'model_type' => 'App\Models\User',
                'model_id' => 1,
            ],
            [
                'role_id' => 2,
                'model_type' => 'App\Models\User',
                'model_id' => 2,
            ],
            [
                'role_id' => 3,
                'model_type' => 'App\Models\User',
                'model_id' => 3,
            ],
        ];

        foreach ($data as $key => $value) {
            \DB::table('model_has_roles')->insert($value);
        }
    }
}
