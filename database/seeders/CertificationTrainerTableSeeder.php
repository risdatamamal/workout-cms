<?php

namespace Database\Seeders;

use App\Models\CertificationTrainer;
use Illuminate\Database\Seeder;

class CertificationTrainerTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'trainer_id' => 1,
                'name'      => 'Indonesia Aerobic and Fitness Association',
                'code_name' => 'IAFA',
            ],
            [
                'trainer_id' => 1,
                'name'      => 'Yoga Alliance Indonesia',
                'code_name' => 'YAI'
            ],
            [
                'trainer_id' => 1,
                'name'      => 'Zumba Education Specialist',
                'code_name' => 'ZES'
            ],
        ];

        foreach ($data as $key => $value) {
            CertificationTrainer::create($value);
        }
    }
}
