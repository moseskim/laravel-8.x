<?php

namespace Database\Factories;

use App\Models\EloquentCustomer;
use Illuminate\Database\Eloquent\Factories\Factory;

class EloquentCustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EloquentCustomer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
