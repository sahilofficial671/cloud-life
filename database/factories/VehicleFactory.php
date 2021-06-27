<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'model'                   => collect(['Twister', 'Pulser', 'Apache 4v', 'Splender'])->random(),
            'detail'                  => $this->faker->text(50),
            'manufacturer'            => collect(['Honda', 'Bajaj', 'KTM', 'Royal Enfield', 'Hero'])->random(),
            'rc'                      => $this->faker->regexify('[A-Z]{6}[0-6]{3}'),
            'monthly_service_in_days' => 22,
            'category_id'             => collect([1, 2])->random(),
            'user_id'                 => 1,
        ];
    }
}
