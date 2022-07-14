<?php

use Illuminate\Database\Seeder;
use App\Models\ApartmentService;
use App\Models\Service;
use App\Models\Apartment;
use Illuminate\Support\Arr;

class ApartmentServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service_id = Service::pluck('id')->toArray();
        $apartment_id = Apartment::pluck('id')->toArray();
        
        for ($i = 0; $i < 200; $i++) {
            $apartment_service = new ApartmentService();

            $apartment_service->service_id = Arr::random($service_id);
            $apartment_service->apartment_id = Arr::random($apartment_id);

            $apartment_service->save();

        }
    }
}
