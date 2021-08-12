<?php

namespace Database\Factories;

use App\Models\generalSettings;
use Illuminate\Database\Eloquent\Factories\Factory;

class generalSettingsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = generalSettings::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => 'Rkixinvest is a laravel based Investment managament system with multi level referral system'
        ];
    }
}
