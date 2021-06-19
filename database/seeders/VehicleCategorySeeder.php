<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleCategory;

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
