<?php

namespace Database\Factories;
use App\Models\packages;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class packagesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = packages::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name,
            'min_invest'=>$this->faker->randomDigit(),
            'max_invest'=>$this->faker->randomDigit(),
            'roi'=>$this->faker->faker->randomDigit(),
            'roi_type'=>$this->faker->randomElement([
                'daily',
                'weekly',
                'monthly',
                'yearly',
            ]),
            'description'=>$this->faker->paragraph(),
        ];
    }
}
