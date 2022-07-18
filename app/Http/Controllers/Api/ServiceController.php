<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ApartmentService;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();

        return response()->json( compact('services') );
    }

    public function apaservice()
    {
        $apaserviceid = ApartmentService::all();

        return response()->json( compact('apaserviceid') );
    }
}
