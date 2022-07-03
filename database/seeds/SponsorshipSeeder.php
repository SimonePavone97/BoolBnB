<?php

use Illuminate\Database\Seeder;
use App\Models\Sponsorship;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsorship = new Sponsorship();
        $sponsorship->name = 'Plus';
        $sponsorship->price = 2.99;
        $sponsorship->duration = 24;  
        $sponsorship->save();

        $sponsorship = new Sponsorship();
        $sponsorship->name = 'Premium';
        $sponsorship->price = 5.99;
        $sponsorship->duration = 72;  
        $sponsorship->save();

        $sponsorship = new Sponsorship();
        $sponsorship->name = 'Gold';
        $sponsorship->price = 9.99;
        $sponsorship->duration = 144;  
        $sponsorship->save();
    }
}
