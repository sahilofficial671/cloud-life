<?php

namespace Database\Seeders;

use App\Models\VehicleCategory;
use Illuminate\Database\Seeder;

class VehicleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VehicleCategory::create([
            'name'   => 'Two Wheeler',
            'description' => 'Two wheelers comes under this category.',
        ]);

        VehicleCategory::create([
            'name'   => 'Four Wheeler',
            'description' => 'Four wheelers comes under this category.',
        ]);
    }
}
