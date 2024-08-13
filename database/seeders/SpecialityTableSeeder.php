<?php

namespace Database\Seeders;

use App\Models\Speciality;
use Illuminate\Database\Seeder;

class SpecialityTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Zumba',
                'is_active' => 1,
            ],
            [
                'name' => 'Yoga',
                'is_active' => 1,
            ],
            [
                'name' => 'Aerobic',
                'is_active' => 1,
            ],
            [
                'name' => 'Pilates',
                'is_active' => 1,
            ],
        ];

        foreach ($data as $key => $value) {
            Speciality::create($value);
        }
    }
}
