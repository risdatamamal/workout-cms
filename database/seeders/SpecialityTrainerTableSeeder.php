<?php

namespace Database\Seeders;

use App\Models\SpecialityTrainer;
use Illuminate\Database\Seeder;

class SpecialityTrainerTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'trainer_id'    => 1,
                'speciality_id' => 1
            ],
            [
                'trainer_id'    => 1,
                'speciality_id' => 2
            ],
            [
                'trainer_id'    => 1,
                'speciality_id' => 3
            ],
        ];

        foreach ($data as $key => $value) {
            SpecialityTrainer::create($value);
        }
    }
}
