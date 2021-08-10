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
         'web_title' => 'Rkix investment system',
        'description' => 'lorem ipsum dummy text.lorem ipsum dummy text.',
            'refrel_system' => 'off',
            'refrellevel_type' => '6',
            'reward_system' => 'off',
            'email_verification' => 'off',

        ];
    }
}
