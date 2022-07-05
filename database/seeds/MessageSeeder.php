<?php

use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\Apartment;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

 class MessageSeeder extends Seeder
 {
     /**
      * Run the database seeds.
      *
      * @return void
      */
     public function run(Faker $faker)
     {
         $apartment_ids = Apartment::pluck('id')->toArray();

         for ($i = 0; $i < 4 ; $i++) {
             $message = new Message();
             $message->apartment_id = Arr::random($apartment_ids);
             $message->sender = $faker->name();
             $message->text = $faker->paragraph();
             $message->email = $faker->word();
             $message->save();

         }
     }
 }
