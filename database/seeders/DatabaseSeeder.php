<?php

namespace Database\Seeders;

use App\Models\Packages;
use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Factories\packagesFactory;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "first_name" => "Admin",
            "last_name" => "Admin",
            "email" => "admin@autocar.com",
            "password" => Hash::make(123456),
            "type" => 3,

        ]);

    //    $this-> call([
    //     packagesFactory::class,
    //     ]);

    }
}
