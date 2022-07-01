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
        // $user_ids = User::pluck('id')->toArray();

        // for ($i = 0; $i < 10; $i++) {
        //     $apartment = new Apartment();
            
        //     $apartment->user_id = Arr::random($user_ids);
        //     $apartment->title = $faker->sentence;

        // }
    }
}
