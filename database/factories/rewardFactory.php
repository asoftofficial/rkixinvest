<?php

namespace Database\Factories;

use App\Models\reward;
use Illuminate\Database\Eloquent\Factories\Factory;

class rewardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = reward::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'title' => 'reward',
           'amount' => '200',
           'refrel' => '2',
           'status' => 'suspend',
           'description' => 'lorem ipsum dummy text lorem ipsum dummy text vlorem ipsum dummy text lorem ipsum dummy text lorem ipsum dummy text lorem ipsum dummy text lorem ipsum dummy text',



        ];
    }
}
