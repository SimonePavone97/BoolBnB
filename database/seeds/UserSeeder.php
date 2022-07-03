<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->first_name = $faker->firstName();
            $user->last_name = $faker->lastName();
            $user->email = $faker->email();
            $user->password = bcrypt('password');
            $user->birth_date = $faker->date('Y-m-d', '2003-01-01');
            $user->save();
        }
    }
}
