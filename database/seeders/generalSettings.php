<?php

namespace Database\Seeders;

use App\Models\GeneralSettings as ModelsGeneralSettings;
use Illuminate\Database\Seeder;

class generalSettings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsGeneralSettings::factory()->create();

    }
}
