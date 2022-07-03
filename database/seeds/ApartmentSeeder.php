<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Apartment;
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
        $user_ids = User::pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            $apartment = new Apartment();
            
            $apartment->user_id = Arr::random($user_ids);
            $apartment->title = $faker->sentence();
            $apartment->rooms = $faker->numberBetween(1, 20);
            $apartment->bathrooms = $faker->numberBetween(1, 6);
            $apartment->beds = $faker->numberBetween(1, 20);
            $apartment->mq = $faker->numberBetween(20, 5000);
            $apartment->address = $faker->address();
            $apartment->latitude = round($faker->latitude($min = -90, $max = 90), 5);
            $apartment->longitude = round($faker->longitude($min = -90, $max = 90), 5);
            $apartment->image = 'https://cf.bstatic.com/xdata/images/hotel/max1024x768/267316381.jpg?k=86b64cf28cd12f4c6feb7b7be23c8bcce91b2cd1be7c48a7383c4297d8d695ce&o=&hp=1';
            $apartment->visibility = $faker->boolean();
            $apartment->description = $faker->sentence();

            $apartment->save();

        }
    }
}
