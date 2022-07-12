<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Apartment;
use App\Models\Service;
use App\User;
use Illuminate\Support\Arr;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartments = config('apartments');

        $user_ids = User::pluck('id')->toArray();

        foreach ($apartments as $apartment) {
            $new_apartment = new Apartment();
            
            $new_apartment->fill($apartment);

            $new_apartment->rooms = $faker->numberBetween(1, 10);
            $new_apartment->bathrooms = $faker->numberBetween(1, 4);
            $new_apartment->beds = $faker->numberBetween(1, 20);
            $new_apartment->mq = $faker->numberBetween(20, 500);

            // Chiamata a TOMTOM API per calcolo latitude e logitude
            $APIrequest = 'https://api.tomtom.com/search/2/geocode/' . $new_apartment->address . '.json?key=cMTORuMrpmoMysQnNBGRyAx2g8Nmo8P9';
            $response = Http::get($APIrequest)->json();
            $new_apartment->longitude = $response['results'][0]['position']['lon'];
            $new_apartment->latitude = $response['results'][0]['position']['lat'];

            $new_apartment->visibility = $faker->boolean();

            $new_apartment->save();

        }
    }
}
