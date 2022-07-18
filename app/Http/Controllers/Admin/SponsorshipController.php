<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sponsorship;
use App\Models\Apartment;

class SponsorshipController extends Controller
{
    public function index(Apartment $apartment){
        $sponsorships = Sponsorship::all();
        return view('admin.sponsorship.index', compact('sponsorships', 'apartment'));
    }
}
