<?php

namespace Database\Seeders;
use App\Models\Packages;
use Illuminate\Database\Seeder;
use Faker;
class packageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \::create();
        // factory(App\Models\Packages::class)->create();
        Packages::factory()->create();

    }
}
