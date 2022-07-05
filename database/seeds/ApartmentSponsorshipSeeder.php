<?php

use Illuminate\Database\Seeder;
use App\Models\ApartmentSponsorship;
use App\Models\Sponsorship;
use App\Models\Apartment;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;

class ApartmentSponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $sponsorship_id = Sponsorship::pluck('id')->toArray();
        $apartment_id = Apartment::pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            $apartment_sponsorship = new ApartmentSponsorship();

            $apartment_sponsorship->sponsorship_id = Arr::random($sponsorship_id);
            $apartment_sponsorship->apartment_id = Arr::random($apartment_id);
            $apartment_sponsorship->end_sponsorship = $faker->date('Y-m-d', '2003-01-01');

            $apartment_sponsorship->save();

        }
    }
}
