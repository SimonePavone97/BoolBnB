<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(
            [
                UserSeeder::class,
                ServiceSeeder::class,
                ApartmentSeeder::class,
                ApartmentServiceSeeder::class,
                StatSeeder::class,
                MessageSeeder::class,
                SponsorshipSeeder::class,
                ApartmentSponsorshipSeeder::class
            ]
        );
    }
}
