<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class AboutusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
         return [
           'section_title' => 'About us',
           'section_heading' => 'Earn more profit',
           'button_text' => 'more info',
           'link' => 'http://rkixinvest.test/#',
           'section_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus fringilla, ipsum quis pellentesque molestie, ligula neque pretium ipsum, sit amet facilisis odio enim eu mauris.',
        ];
    }
}
