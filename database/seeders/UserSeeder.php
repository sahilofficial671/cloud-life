<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Carbon\Carbon;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'              => 'Sahil Bhatia',
            'email'             => 'sahil@sahil.com',
            'email_verified_at' => Carbon::now(),
            'password'          => Hash::make('sahil1234'),
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);
        User::create([
            'name'              => 'Demo Account',
            'email'             => 'demo@demo.com',
            'email_verified_at' => Carbon::now(),
            'password'          => Hash::make('demo'),
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);
    }
}
