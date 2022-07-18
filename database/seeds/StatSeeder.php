<?php

use Illuminate\Database\Seeder;
use App\Models\Stat;
use App\Models\Apartment;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;


class StatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartment_ids = Apartment::pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            $stat = new Stat();
            $stat->apartment_id = Arr::random($apartment_ids);
            $stat->ip_address = $faker->ipv4();
            $stat->save();
        }
    }
}
