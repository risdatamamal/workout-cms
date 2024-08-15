<?php

namespace Database\Seeders;

use App\Models\Trainer;
use Illuminate\Database\Seeder;

class TrainerTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id'   => 2,
                'contract'  => 2,
                'contracted_at' => now(),
            ],
        ];

        foreach ($data as $key => $value) {
            Trainer::create($value);
        }
    }
}
