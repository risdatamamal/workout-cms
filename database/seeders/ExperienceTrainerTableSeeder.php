<?php

namespace Database\Seeders;

use App\Models\ExperienceTrainer;
use Illuminate\Database\Seeder;

class ExperienceTrainerTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'trainer_id' => 1,
                'year'     => '2009-2014',
                'company'  => 'Gold Gym',
                'position' => 'Aerobic Trainer'
            ],
            [
                'trainer_id' => 1,
                'year'     => '2014-2019',
                'company'  => 'Yoga Community',
                'position' => 'Yoga Trainer'
            ],
            [
                'trainer_id' => 1,
                'year'     => '2019-2024',
                'company'  => 'FTL Gym',
                'position' => 'Zumba Trainer'
            ],
        ];

        foreach ($data as $key => $value) {
            ExperienceTrainer::create($value);
        }
    }
}
