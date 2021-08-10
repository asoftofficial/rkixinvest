<?php

namespace Database\Seeders;

use App\Models\Reward as ModelsReward;
use Illuminate\Database\Seeder;

class reward extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsReward::factory()->create();


    }
}
