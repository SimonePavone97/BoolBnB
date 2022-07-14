<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();

        return response()->json( compact('services') );
    }
}
