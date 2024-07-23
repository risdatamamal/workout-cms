<?php

namespace Database\Seeders;

use App\Models\MemberPlan;
use Illuminate\Database\Seeder;

class MemberPlanTableSeeder extends Seeder
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
                'name'          => '1 Month',
                'description'   => 'Basic Plan',
                'price_monthly' => 230000,
                'duration'      => 1,
                'is_active'     => 1,
            ],
            [
                'name'          => '3 Months',
                'description'   => 'Standard Plan',
                'price_monthly' => 650000,
                'duration'      => 3,
                'is_active'     => 1,
            ],
            [
                'name'          => '6 Months',
                'description'   => 'Premium Plan',
                'price_monthly' => 1300000,
                'duration'      => 6,
                'is_active'     => 1,
            ],
            [
                'name'          => '12 Months',
                'description'   => 'Ultimate Plan',
                'price_monthly' => 2600000,
                'duration'      => 12,
                'is_active'     => 1,
            ],
        ];

        foreach ($data as $key => $value) {
            MemberPlan::create($value);
        }
    }
}
