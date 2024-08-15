<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            IndoRegionSeeder::class,
            UserTableSeeder::class,
            RoleTableSeeder::class,
            PermissionTableSeeder::class,
            RoleHasPermissionTableSeeder::class,
            ModelHasRoleTableSeeder::class,
            // ModelHasPermissionTableSeeder::class,
            MemberPlanTableSeeder::class,
            SpecialityTableSeeder::class,
            CustomerTableSeeder::class,
            TrainerTableSeeder::class,
            ExperienceTrainerTableSeeder::class,
            SpecialityTrainerTableSeeder::class,
            CertificationTrainerTableSeeder::class,
        ]);
    }
}
