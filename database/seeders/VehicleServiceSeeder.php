<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\VehicleService;
class VehicleServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VehicleService::create([
            'name'         => 'Monthly Service',
            'description'  => 'Bike Monthly Service',
            'vehicle_id'   => 1,
            'type_id'      => 1,
            'scheduled_at' => now(),
            'user_id'      => 1,
        ]);

        VehicleService::create([
            'name'         => 'Custom Break Service',
            'description'  => 'Bike Monthly Service',
            'vehicle_id'   => 1,
            'type_id'      => 2,
            'scheduled_at' => now()->addMonth(),
            'user_id'      => 1,
        ]);

        VehicleService::create([
            'name'         => 'Monthly Service',
            'description'  => 'Bike Monthly Service',
            'vehicle_id'   => 1,
            'type_id'      => 1,
            'scheduled_at' => now()->subMonth(2),
            'serviced_at'  => null,
            'canceled_at'  => now()->subMonth(2),
            'user_id'      => 1,
        ]);

        VehicleService::create([
            'name'         => 'Monthly Service',
            'description'  => 'Bike Monthly Service',
            'vehicle_id'   => 1,
            'type_id'      => 1,
            'scheduled_at' => now()->subMonth(3),
            'serviced_at'  => now()->subMonth(3),
            'user_id'      => 1,
        ]);
    }
}
