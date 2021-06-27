<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vehicle::create([
            'model'                   => collect(['Twister', 'Pulser', 'Apache 4v', 'Splender'])->random(),
            'detail'                  => 'This is service description.',
            'manufacturer'            => collect(['Honda', 'Bajaj', 'KTM', 'Royal Enfield', 'Hero'])->random(),
            'rc'                      => collect(['KSUHF123EKJ', 'EWIRUYIUB', 'AKFGGBTRYO2'])->random(),
            'monthly_service_in_days' => 22,
            'category_id'             => collect([1, 2])->random(),
            'user_id'                 => 1
        ]);

        Vehicle::create([
            'model'                   => collect(['Twister', 'Pulser', 'Apache 4v', 'Splender'])->random(),
            'detail'                  => 'This is service description.',
            'manufacturer'            => collect(['Honda', 'Bajaj', 'KTM', 'Royal Enfield', 'Hero'])->random(),
            'rc'                      => collect(['KSUHF123EKJ', 'EWIRUYIUB', 'AKFGGBTRYO2'])->random(),
            'monthly_service_in_days' => 30,
            'category_id'             => collect([1, 2])->random(),
            'user_id'                 => 1
        ]);
    }
}
