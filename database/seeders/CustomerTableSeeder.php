<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
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
                'user_id' => 3,
                'member_plan_id' => 1,
            ],
        ];

        foreach ($data as $key => $value) {
            Member::create($value);
        }
    }
}
