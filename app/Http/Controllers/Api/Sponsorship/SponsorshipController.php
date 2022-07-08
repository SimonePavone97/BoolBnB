<?php

namespace App\Http\Controllers\Api\Sponsorship;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sponsorship;
use App\Http\Resources\SponsorshipResource;

class SponsorshipController extends Controller
{
    public function index(Request $request){
        $sponsorships = Sponsorship::all();

        return SponsorshipResource::collection($sponsorships);
    }
}
