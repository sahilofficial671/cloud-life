<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
            UserSeeder::class,
            VehicleCategorySeeder::class,
        ]);

        \App\Models\Vehicle::factory(4)->create();

        $this->call([
            VehicleServiceSeeder::class,
        ]);
    }
}
