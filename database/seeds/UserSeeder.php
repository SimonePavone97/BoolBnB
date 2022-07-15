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
        $users = [
            ["first_name" => "Pippo", "last_name" => "Goofy", "email" => "pippogoofy@gmail.com"],
            ["first_name" => "Donald", "last_name" => "Duck", "email" => "donaldduck@gmail.com"],
            ["first_name" => "Mikey", "last_name" => "Mouse", "email" => "mikeymouse@gmail.com"],
            ["first_name" => "Minnie", "last_name" => "Mouse", "email" => "minniemouse@gmail.com"]
        ];

        for ($i = 0; $i < count($users); $i++) {
            $user = new User();

            $user->first_name = $users[$i]["first_name"];
            $user->last_name = $users[$i]["last_name"];
            $user->email = $users[$i]["email"];

            $user->password = bcrypt('password');
            $user->birth_date = $faker->date('Y-m-d', '2003-01-01');
            $user->save();
        }
    }

}
