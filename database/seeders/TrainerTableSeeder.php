<?php

namespace Database\Seeders;

use App\Models\Trainer;
use Illuminate\Database\Seeder;

class TrainerTableSeeder extends Seeder
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
                'user_id'   => 2,
                'contract'  => 2,
                'experience' => [
                    [
                        'position' => 'Aerobic Trainer',
                        'company'  => 'Gold Gym',
                        'year'     => '2009-2014'
                    ],
                    [
                        'position' => 'Yoga Trainer',
                        'company'  => 'Yoga Community',
                        'year'     => '2014-2019'
                    ],
                    [
                        'position' => 'Zumba Trainer',
                        'company'  => 'FTL Gym',
                        'year'     => '2019-2024'
                    ],
                ],
                'speciality' => [
                    'Aerobic',
                    'Yoga',
                    'Zumba'
                ],
                'certification' => [
                    [
                        'name'      => 'Indonesia Aerobic and Fitness Association',
                        'code_name' => 'IAFA',
                    ],
                    [
                        'name'      => 'Yoga Alliance Indonesia',
                        'code_name' => 'YAI'
                    ],
                    [
                        'name'      => 'Zumba Education Specialist',
                        'code_name' => 'ZES'
                    ],
                ],
                'contracted_at' => now(),
            ],
        ];

        foreach ($data as $key => $value) {
            Trainer::create($value);
        }
    }
}
